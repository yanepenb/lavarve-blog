<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleValidate;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();

        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('article.show', compact('article'));
    }

    public function create()
    {
        // Передаём в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }

    // Здесь нам понадобится объект запроса для извлечения данных
    public function store(ArticleValidate $request)
    {
        // Проверка введённых данных
        // Если будут ошибки, то возникнет исключение
        // $this->validate($request, [
        //     'name' => 'required|unique:articles',
        //     'body' => 'required|min:10',
        // ]);
        //второй способ валидации через Form Request.
        $validated = $request->validated();

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($request->all());
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут с добавлением флеш-сообщения
        $request->session()->flash('status', 'Create was successful!');
        return redirect()
            ->route('articles.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }


    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->validate($request, [
            // У обновления немного изменённая валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:100',
        ]);

        $article->fill($request->all());
        $article->save();
        $request->session()->flash('status', 'Update was successful!');
        return redirect()
            ->route('articles.index');
    }

    // Не забывайте про авторизацию (здесь не рассматривается)
    // Удаление должно быть доступно только тем, кто может его выполнять
    public function destroy($id)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        $article = Article::find($id);
        if ($article) {
        $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
