<!DOCTYPE html>
<html>
<head>
    <title>Form Example</title>
</head>
<body>
    <form action="{{ route('jsonPost') }}" method="POST">
        @csrf
        <label for="dateFrom">Дата от:</label>
        <input type="date" name="dateFrom" id="dateFrom">
        <br>
        <label for="dateTo">Дата до:</label>
        <input type="date" name="dateTo" id="dateTo">
        <br>
        <input type="radio" id='stocks' name='dataModule' value='stocks'>
        <label for="stocks">Склады</label>
        <input type="radio" id='incomes' name='dataModule' value='incomes'>
        <label for="incomes">Доходы</label>
        <input type="radio" id='orders' name='dataModule' value='orders'>
        <label for="orders">Заказы</label>
        <input type="radio" id='sales' name='dataModule' value='sales'>
        <label for="sales">Продажи</label>
        <br>
        <button type="submit">Submit</button>
    </form>
    @isset($jsonData)
        @foreach ($jsonData as $item)
            <pre>{{ is_array($item) ? print_r($item, true) : htmlspecialchars($item) }}</pre>
        @endforeach
    @endisset   
</body>
</html>
