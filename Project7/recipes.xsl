<xsl:stylesheet version = "2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
        <body>
        <center><h2 style="color:Navy;"><u><xsl:value-of select="//collection/description"/></u></h2></center>
        <xsl:for-each select="//recipe">
           <center><i><b><h2 style="color:Green;"><xsl:value-of select="title" /></h2></b></i></center>
            <h4>Date:</h4><xsl:value-of select = "date" />
            <br />
            <h4>Ingredients:</h4>
            <table border="1">
                <tr bgcolor="#9acd32">
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Unit</th>
                    
            
                </tr>
                <xsl:for-each select="ingredient">
                    <tr>
                        <td><b><i><xsl:value-of select="@name"/></i></b><br/>
                            <ul>
                            <xsl:for-each select="ingredient">
                            <li>
                            Ingredient need:<xsl:choose><xsl:when test="@name"><xsl:value-of select="@name"/><br/></xsl:when></xsl:choose>
                            <ul><xsl:for-each select="ingredient">
                            <li>
                            Ingredient:<xsl:choose><xsl:when test="@name"><xsl:value-of select="@name"/><br/></xsl:when></xsl:choose>
                            <ul><xsl:for-each select="ingredient">
                            <li>
                            Ingredient:<xsl:choose><xsl:when test="@name"><xsl:value-of select="@name"/><br/></xsl:when></xsl:choose>
                            Amount:<xsl:choose><xsl:when test="@amount"><xsl:value-of select="@amount"/><br/></xsl:when></xsl:choose>
                            Unit:<xsl:choose><xsl:when test="@unit"><xsl:value-of select="@unit"/><br/></xsl:when></xsl:choose>
                            </li>
                            </xsl:for-each></ul>
                            <xsl:choose>
                            <xsl:when test="./preparation">
                            <b>Preparation:</b>
                            <ul>
                            <xsl:for-each select="preparation/step">
                            <li>
                                    <xsl:value-of select="."/></li>
                            </xsl:for-each>
                            </ul>
                            </xsl:when>
                            </xsl:choose>
                            </li>
                            </xsl:for-each></ul>
                            </li>
                            </xsl:for-each>
                             </ul>
                            <ul>
                            <xsl:choose>
                            <xsl:when test="./preparation">
                            <b>Preparation:</b>
                            <xsl:for-each select="preparation/step">
                                <li>
                                    <xsl:value-of select="."/>
                                </li>
                            </xsl:for-each>
                            </xsl:when>
                            </xsl:choose>
                            </ul>
                            
                        </td>
                        <td><xsl:value-of select="@amount"/></td>
                        <td><xsl:value-of select="@unit"/></td>
                        


                    </tr>
              </xsl:for-each>
              </table>
            <br />
            <h4>Preparation:</h4>
            <ol>
                <xsl:for-each select="preparation/step">
                    <li>
                        <xsl:value-of select="." />
                    </li>
                </xsl:for-each>
            </ol>
            <xsl:choose><xsl:when test="comment"><h4>Comment:</h4><xsl:value-of select ="comment"/></xsl:when></xsl:choose>
            <h4>Nutrition:</h4>
            <table border="2">
                <tr bgcolor="#808080">
                    <th>Calories</th>
                    <th>Fat</th>
                    <th>carbohydrates</th>
                    <th>protein</th>
                </tr>
                <xsl:for-each select="nutrition">
                    <tr>
                        <td><xsl:value-of select="@calories"/></td>
                        <td><xsl:value-of select="@fat"/></td>
                        <td><xsl:value-of select="@carbohydrates"/></td>
                        <td><xsl:value-of select="@protein"/></td>
                        
                    </tr>
              </xsl:for-each>
              </table>
              <xsl:choose><xsl:when test="related"><h4>Related:</h4><xsl:value-of select="related"/></xsl:when></xsl:choose>

            </xsl:for-each>
            
            
        </body>
        </html>

    </xsl:template>
</xsl:stylesheet>
