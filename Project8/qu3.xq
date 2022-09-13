<html>
<body>
<title>Name of Persons and No. of items bought</title>&#10;
{
    for $people in doc("auction.xml")/site/people//person
    let $x := data($people/@id)
    for $cAuction in doc("auction.xml")/site/closed_auctions//closed_auction
    return if ($x= $cAuction/buyer/@person) then 
    {
        <person>&#xa;{$people/name}&#xa;
        {doc("auction.xml")/$cAuction/quantity/string()}&#xa;</person>,'&#xa;'
    }
    else {}
}
</body>
</html>


