<html>
<body>
<title>List of all items albhabetically with their location</title>
{
for $x in doc("auction.xml")/site/regions//item
order by $x/name
return {
    (
        '&#10;', $x/name, '&#10;',$x/location
    )
}
}
</body>
</html>