<html>
<body>
<title>category</title>

{
    for $x in doc("auction.xml")/site/categories/category ,
        $y in doc("auction.xml")//people/person
    
    
    where $x/@id = $y/profile/interest/@category

    group by $x/@id

    return {
        
        ('&#10;',<category>
        {$x/name} &#10;
        <count> {count($y)}</count>
          </category>)
          
    }
}  
</body>
</html>