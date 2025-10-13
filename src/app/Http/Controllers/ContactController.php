<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $contact = $request->old() ?: $request->all();

        return view('index', compact('categories', 'contact'));
    }

    public function confirm(ContactRequest $request)
    {
        //dd($request->all());

        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        $contact['tel1'] = $request->input('tel1');
        $contact['tel2'] = $request->input('tel2');
        $contact['tel3'] = $request->input('tel3');

        $contact['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

        $contact['category_name'] = \App\Models\Category::find($contact['category_id'])->content;
        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        $contact['tel'] = $tel;

        Contact::create($contact);

        return redirect('thanks');
    }

    public function admin(Request $request)
    {
        $query = Contact::query();
        // キーワード検索（名前・メール）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('first_name', 'like', "%{$keyword}%")
            ->orWhere('last_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%");
        });
    }
        // 性別検索
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // カテゴリ検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->paginate(7);
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました');
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                ->orWhere('last_name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
    }
        $contacts = $query->with('category')->get();

        $csvHeader = [
            'ID',
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '登録日時'
        ];

        $csvData = [];
        $csvData[] = $csvHeader;

        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->id,
                $contact->last_name . ' ' . $contact->first_name,
                $genders[$contact->gender] ?? '',
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building ?? '',
                $contact->category->content ?? '',
                $contact->detail,
                $contact->created_at->format('Y/m/d H:i:s'),
            ];
        }

        $filename = 'contacts_' . date('YmdHis') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
