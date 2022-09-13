
<html>
<body>
<title>The Number of Items listed on all continents</title>
{
let $x := doc("auction.xml")/site/regions//item
return
<count>{count($x)}</count>
}
</body>
</html>