![default](https://user-images.githubusercontent.com/8466209/201396853-75d12ee6-a80f-4b1c-b3a0-c7a3a808aaca.png)


[![default](https://user-images.githubusercontent.com/8466209/202141967-f86798ad-4aff-48ee-b09f-b1645b330276.png)](https://en.wikipedia.org/wiki/List_of_S%26P_500_companies)

> The components that have increased their dividends in 25 consecutive years are known as the S&P 500 Dividend Aristocrats. The index is one of the factors in computation of the Conference Board Leading Economic Index, used to forecast the direction of the economy. _Aource: [Google Finance](https://www.google.com/finance/quote/.INX:INDEXSP)_

*****50 x 10 = 500*****
```
  -----------------------+----+----+----+----+----+----+----+----+----+----- 3rd Twin
    5 → π(72) → 18 (Δ13) | 61 | 67 | 71 |  - |  - |  - |  - |  - |  - |20th
  =======================+====+====+====+====+====+====+====+====+====+===== 4th Twin
    3,2 → 18+13+12 → 43  | 73 | 79 | 83 | 89 | 97 | 101| 103| 107| 109|29th 
  =======================+====+====+====+====+====+====+====+====+====+=====
                                           ↓
                                           |
                                           ↓                                          
                            114-89=139-114=25=5x5
                                | 
                                |                              ----------- 5 -----------
                                |                             |                         |  
                                ↓                             ↑                         ↓
 |   mapping    |     feeding     |  lexering    |  parsering   |   syntaxing   |  grammaring  |
 |------------- 36' --------------|----------------------------36' ----------------------------|
 |     19'      |        17'      |      13'     |      11'     |       7'      |       5'     |
 +----+----+----+---+----+----+---+---+----+-----+----+----+----+----+----+-----+----+----+----+
 |  1 |  2 |  3 | 4 |  5 |  6 | 7 | 8 |  9 |  10 | 11 | 12 | 13 | 14 | 15 |  16 | 17 | 18 | 19 |
 +----+----+----+---+----+----+---+---+----+-----+----+----+----+----+----+-----+----+----+----+
 |  2 | 60 | 40 | 1 | 30 | 30 | 5 | 1 | 30 | 200 |  8 | 40 | 50 |  1 | 30 | 200 |  8 | 10 | 40 |
 +----+----+----+---+----+----+---+---+----+-----+----+----+----+----+----+-----+----+----+----+
                                ↓                             ↑                         ↓
                                |                             |                         |
             50 x 10 = 500 ----→ ------------- 10 -------------                          | 
                                                                                        | 
                                                                                        | 
   -----------------------+----+----+----+----+----+----+----+----+----+-----           |
   True Prime Pairs Δ    |  1 |  2 |  3 |  4 |  5 |  6 |  7 |  8 |  9 | Sum             |
  =======================+====+====+====+====+====+====+====+====+====+=====            ↓
   19 → π(10)            |  2 |  3 |  5 |  7 |  - |  - |  - |  - |  - | 4th  ◄- 4 =  π(10)
  -----------------------+----+----+----+----+----+----+----+----+----+-----
```


```
//Updated on 10-6-2015 By ChrisMoody
//Added Linebr ability, ability to turn on/off highlight Bars when crossing Swing Hi/Lo
//Added Ability to turn on/off background highlight when bars cross swing hi/lo
//Created 99% by Glaz and ChrisMoody Modified about 1% on 7/30/2014 for user dvk197-

study(title="CM_Gann Swing HighLow V2", shorttitle="CM_Gann_Swing_HL_V2", overlay=true)
periods=input(3, minval=1, title="Moving Average Period")
pt = input(false, title="Plot Up/Down Triangles at Top and Bottom of Candles/Bars?")
pc = input(true, title="Plot Circles at Top and Bottom of Candles/Bars?")
pttb = input(true, title="Plot Triangles at Top and Bottom of Screen?")
shb = input(false, title="Show Highlight Bars on Cross Up or Cross Down?")
sbh = input(true, title="Show Background Highlights at Cross Up or Cross Down?")

//code for Calculations
hld = iff(close > sma(high,periods)[1], 1, iff(close<sma(low,periods)[1],-1, 0))
hlv = valuewhen(hld != 0, hld, 1)

//code for Plot Statements
hi = hlv == -1 ? sma(high, periods) : na
lo = hlv == 1 ? sma(low,periods) : na

//Rules for coloring Background highlights & Highlight Bars
closeAbove() => shb and close > hi and close[1] < hi
BHcloseAbove = sbh and close > hi and close[1] < hi
closeBelow() => shb and close < lo and close[1] > lo
BHcloseBelow = sbh and close < lo and close[1] > lo

//Highlight Bar Color Plots
barcolor(closeAbove() ? yellow : na)
barcolor(closeBelow() ? yellow : na)
//Background Highlight Rules
bgcolor(BHcloseAbove ? green : na, transp=60)
bgcolor(BHcloseBelow ? red : na, transp=60)

//Plot Statements for circles and Triangle Up/Down at Price Bars
plot(pc and hi ? hi : na,title="Gann Swing High Plots-Circles", color=fuchsia,style=linebr, linewidth=4)
plot(pc and lo ? lo : na,title="Gann Swing Low Plots-Circles", color=lime,style=linebr, linewidth=4)
plotshape(pt and hi ? hi : na,title="Gann Swing High Plots-Triangle Down", offset=0, style=shape.triangledown, location=location.abovebar, color=fuchsia, transp=0)
plotshape(pt and lo ? lo : na,title="Gann Swing Low Plots-Triangle Up", offset=0, style=shape.triangleup, location=location.belowbar, color=lime, transp=0)

//Plot Statement for Triangles at Top and Bottom of Screen
plotshape(pttb and hi ? hi : na,title="Gann Swing High Plots-Triangles Down Top of Screen", offset=0, style=shape.triangledown, location=location.top, color=red, transp=0)
plotshape(pttb and lo ? lo : na, title="Gann Swing Low Plots-Triangles Up Bottom of Screen",offset=0, style=shape.triangleup, location=location.bottom, color=lime, transp=0)
```
[![2022-11-26 (1)](https://user-images.githubusercontent.com/8466209/204060638-bee5515b-9f5c-441c-b374-6027f66b7726.png)
](https://www.tradingview.com/script/ngO3BO37-CM-Gann-Swing-High-Low-V2/)

> Gann was born June 6, 1878, in Lufkin, Texas. His father was a cotton farmer. He started trading in 1902 when he was 24.[24] He was believed to be a great student of the Bible, who believed that it was the greatest book ever written Likewise, Henry W Steele[34] demonstrates in a YouTube video that the numbers in Gann's work often refer to a different subject from what they appear on the surface. For example, on page one and two of Forty-Five Years in Wall Street,[35] there is a paragraph describing the different stocks at different prices on 14 June 1949, but Steele discovered that those "prices" are actually astrological aspects appearing in the sky on that day. _Source [Wikipedia](https://en.wikipedia.org/wiki/William_Delbert_Gann#Bibliography)_

[![default](https://user-images.githubusercontent.com/8466209/201389693-d0b4a41a-90bc-475f-89ee-ecf4e154c63e.png)](https://www.bing.com/images/search?q=gann+hexagon+chart)

WD Gann is well known as the greatest market researcher of all time. He researched every possible aspect of natural laws in conjuction with variables of price and time in market movements. Find more detail _[here](https://github.com/eq19/parser/files/10151301/gann-time-factor.pdf)_ and _[here](https://github.com/eq19/parser/files/10151302/master-time-factor.pdf)_.
