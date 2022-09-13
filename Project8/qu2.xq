<html>
<body>
<h1>List of Items in Europe.</h1>
<ul>
{
    for 
    $x in doc("auction.xml")/site/regions/europe/item
    return {
        <li>
        {$x/name}
        {$x/description}
        </li>
}
}
</ul>
</body>
</html>