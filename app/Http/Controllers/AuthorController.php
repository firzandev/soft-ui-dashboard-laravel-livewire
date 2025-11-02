<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use DataTables;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        return \DataTables::of(Author::query())
            ->addColumn('image', function($author) {
                return asset('assets/img/' . $author->image);
            })
            ->make(true);
    }
}