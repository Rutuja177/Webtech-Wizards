<html>
<body>
<title>Names of Persons and the items they bought in Europe</title>
{
for $x in doc("auction.xml")/site/closed_auctions/closed_auction,
    $y in doc("auction.xml")/site/regions/europe/item,
    $z in doc("auction.xml")//people/person

where 
$x/buyer/@person = $z/@id 
and 
$x/itemref/@item= $y/@id

group by
$z/@id

return ({'&#10;',<person>{$z/name}<item>{$y/name}</item></person>,'&#10;'})

}
</body>
</html>