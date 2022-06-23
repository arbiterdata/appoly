<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    </head>
    <body class="antialiased">
    <div>
        <form action="item/store" method="POST">
                @csrf
                @method('POST')
                <h4>Create new item</h4>
                <label>Name: </label><input type="text" name="name" id="name"></input>
                <input type="submit"></submit>
        </form>

        <form action="child/store" method="POST">
            @csrf
            @method('POST')
            <h4>Create new child</h4>
            <label for="item">Item parent:</label>
                <select id="item_id" name="item_id">
                @foreach ($items as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                </select>
            <label>Name: </label><input type="text" name="name" id="name"></input>
            <input type="submit"></submit>
        </form>

        <h4>List of items and children</h4>

            @forelse ($items as $item)
            <ul>
            <li><p>{{$item->name}} <a style="color:red" href="/item/delete/{{$item->id}}">delete</a></p></li> 
                @forelse ($item->children as $child)
                    <ul>
                    <li>{{$child->name}} <a style="color:red" href="/child/delete/{{$child->id}}"> delete</a></li>
                    </ul>
                @empty
                @endforelse
            </ul>
            @empty
            <p>No data<p>
            @endforelse
        </div>

        <form action="/cron">
            @csrf 
            <input type="submit" value="Cron"></input>
        </form>
    </body>
    <script>
    </script>
</html>
