<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(){
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        $csvData = Contact::all();
        return view('admin',compact('contacts','categories',
        'csvData'));
    }

    public function search(Request $request){
        if($request->has('reset')){
            return redirect('admin')->withInput();
        }

        $query = Contact::query();

        $query = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->created_at);

        $contacts = $query->paginate(7);
        $csvData = $query->get();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories',
        'csvData'));
    }

    public function export(Request $request){
        $query = Contact::query();

        $query = Contact::query()->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->created_at);

        $csvData = $query->get()->toArray();

        $csvHeader = [
            'id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail', 'created_at', 'updated_at'
        ];

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            //データを書き込むためのファイルを作成＆オープン
            $createCsvFile = fopen('php://output', 'w');
            //ヘッダーの文字列のエンコード
            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);
            //ファイルにヘッダーの文字列をcsv形式で書き込む
            fputcsv($createCsvFile, $csvHeader);

            //ブラウザ上で一覧表示されているデータをCSVに書き込む
            foreach ($csvData as $csv) {
                fputcsv($createCsvFile, $csv);
            }

            //ファイルの書き込みが終わったので、ファイルを閉じる
            fclose($createCsvFile);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contact.csv"'
        ]);

        return $response;
    }

    public function destroy(Request $request){
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
