<html>
<body>
<title>Reserve Prices of Open auction</title>
{
for $x in doc("auction.xml")/site/open_auctions/open_auction
where index-of($x/bidder/personref/@person,'person3')< index-of($x/bidder/personref/@person,'person6')
return data($x/reserve)
}
</body>
</html>