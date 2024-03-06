<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>


    .snowflake {
  position: absolute;
  width: 10px;
  height: 10px;
  background: linear-gradient(white, white);
  /* Workaround for Chromium's selective color inversion */
  border-radius: 50%;
  filter: drop-shadow(0 0 10px white);
}


    .header_section .navbar-nav .nav-item .nav-link:hover {
        color: #000dff !important;
    }



    .stars-background {
        border-radius: 100%;
        background: transparent;
        animation: animStar 10s linear infinite;
        position: fixed;
        z-index: -2;
        left: 0;
        top: 0;
    }


    .stars-background.medium {
        width: 1.5px;
        height: 1.5px;
        box-shadow: 2407px 2944px #000dff, 1900px 2278px #000dff, 458px 3374px #000dff, 832px 158px #000dff, 155px 1606px #000dff, 640px 3725px #000dff, 2055px 3513px #000dff, 1283px 2244px #000dff, 1245px 1230px #000dff, 892px 851px #000dff, 819px 1183px #000dff, 957px 2862px #000dff, 499px 2354px #000dff, 1283px 3570px #000dff, 1980px 3523px #000dff, 39px 1926px #000dff, 305px 704px #000dff, 1788px 3981px #000dff, 2177px 1947px #000dff, 2354px 2109px #000dff, 949px 3782px #000dff, 2411px 3445px #000dff, 107px 1681px #000dff, 1389px 973px #000dff, 1829px 2206px #000dff, 1026px 1695px #000dff, 743px 3508px #000dff, 209px 3941px #000dff, 2248px 2921px #000dff, 2377px 3882px #000dff, 208px 11px #000dff, 1706px 2128px #000dff, 1978px 147px #000dff, 1304px 2228px #000dff, 350px 3615px #000dff, 2195px 1730px #000dff, 664px 1226px #000dff, 1932px 252px #000dff, 1435px 2865px #000dff, 1766px 1339px #000dff, 314px 14px #000dff, 1055px 2726px #000dff, 40px 1080px #000dff, 113px 2950px #000dff, 2076px 3152px #000dff, 1052px 628px #000dff, 112px 1072px #000dff, 1337px 3951px #000dff, 700px 3118px #000dff, 1567px 310px #000dff, 742px 2807px #000dff, 11px 1376px #000dff, 1769px 1148px #000dff, 670px 212px #000dff, 1850px 3606px #000dff, 1694px 3192px #000dff, 599px 634px #000dff, 238px 3646px #000dff, 1229px 149px #000dff, 772px 3719px #000dff, 2436px 735px #000dff, 2115px 2394px #000dff, 805px 2392px #000dff, 942px 2368px #000dff, 2423px 3545px #000dff, 872px 1344px #000dff, 1720px 66px #000dff, 638px 2840px #000dff, 1980px 355px #000dff, 881px 1932px #000dff, 2178px 1196px #000dff, 191px 334px #000dff, 1673px 2253px #000dff, 161px 1454px #000dff, 71px 2880px #000dff, 129px 723px #000dff, 2169px 322px #000dff, 1030px 2566px #000dff, 636px 1669px #000dff, 662px 1698px #000dff, 1511px 1849px #000dff, 1114px 3808px #000dff, 933px 3056px #000dff, 857px 2617px #000dff, 9px 2801px #000dff, 1178px 125px #000dff, 1766px 3693px #000dff, 502px 1889px #000dff, 2371px 1857px #000dff, 2288px 3968px #000dff, 27px 2791px #000dff, 1469px 2562px #000dff, 832px 3823px #000dff, 768px 1851px #000dff, 997px 3214px #000dff, 1139px 3630px #000dff, 1533px 3410px #000dff, 981px 1473px #000dff, 989px 1739px #000dff, 2298px 2257px #000dff, 1577px 1332px #000dff, 145px 1124px #000dff, 468px 2706px #000dff, 1183px 338px #000dff, 1247px 3699px #000dff, 921px 2965px #000dff, 2448px 346px #000dff, 1238px 2756px #000dff, 244px 168px #000dff, 1154px 2772px #000dff, 1839px 2194px #000dff, 363px 3953px #000dff, 908px 2816px #000dff, 808px 2976px #000dff, 790px 239px #000dff, 1952px 1386px #000dff, 1082px 3404px #000dff, 827px 952px #000dff, 7px 3185px #000dff, 917px 823px #000dff, 70px 2103px #000dff, 1248px 1311px #000dff, 1476px 367px #000dff, 2363px 2713px #000dff, 830px 184px #000dff, 207px 1708px #000dff, 1942px 1800px #000dff, 1560px 2035px #000dff, 1042px 1086px #000dff, 1093px 24px #000dff, 1313px 1703px #000dff, 966px 1423px #000dff, 1665px 3139px #000dff, 427px 1344px #000dff, 134px 2736px #000dff, 618px 3477px #000dff, 912px 3443px #000dff, 328px 871px #000dff, 376px 1116px #000dff, 172px 3721px #000dff, 2363px 1535px #000dff, 247px 3408px #000dff, 186px 1991px #000dff, 1845px 1490px #000dff, 2299px 455px #000dff, 2409px 2395px #000dff, 1828px 1819px #000dff, 511px 1549px #000dff, 93px 496px #000dff, 1835px 2504px #000dff, 2309px 3411px #000dff, 698px 3749px #000dff, 2199px 1466px #000dff, 1513px 644px #000dff, 1975px 1109px #000dff, 1836px 3998px #000dff, 984px 3853px #000dff, 244px 1285px #000dff, 1062px 2924px #000dff, 437px 2283px #000dff, 275px 2991px #000dff, 349px 1371px #000dff, 2337px 3402px #000dff, 304px 947px #000dff, 88px 894px #000dff, 1287px 743px #000dff, 1008px 1456px #000dff, 1306px 3930px #000dff, 2177px 164px #000dff, 683px 3795px #000dff, 229px 3507px #000dff, 1277px 3660px #000dff, 1703px 334px #000dff, 1467px 3793px #000dff, 2037px 922px #000dff, 1953px 880px #000dff, 414px 959px #000dff, 1161px 1577px #000dff, 822px 697px #000dff, 246px 870px #000dff, 1253px 1915px #000dff, 1127px 3000px #000dff, 722px 733px #000dff, 393px 1039px #000dff, 551px 2435px #000dff, 2238px 2216px #000dff, 263px 241px #000dff, 146px 2025px #000dff, 683px 3656px #000dff, 1896px 478px #000dff, 1353px 3574px #000dff, 2155px 3636px #000dff, 655px 76px #000dff, 1391px 1584px #000dff, 1587px 2474px #000dff, 284px 3844px #000dff, 32px 3535px #000dff, 840px 1374px #000dff, 410px 1523px #000dff, 2441px 1910px #000dff, 149px 973px #000dff, 203px 1862px #000dff, 2312px 1681px #000dff, 138px 173px #000dff, 615px 928px #000dff, 441px 2129px #000dff, 1585px 2451px #000dff, 1210px 2098px #000dff, 968px 2387px #000dff, 333px 3267px #000dff, 2100px 3580px #000dff, 613px 1797px #000dff, 1022px 1835px #000dff, 1772px 1692px #000dff, 464px 2908px #000dff, 1540px 1752px #000dff, 2153px 3521px #000dff, 1156px 2938px #000dff, 1250px 3128px #000dff, 880px 3443px #000dff, 2172px 1448px #000dff, 1170px 2214px #000dff, 646px 395px #000dff, 1823px 548px #000dff, 1392px 532px #000dff, 2306px 1978px #000dff, 1518px 3595px #000dff, 2496px 3347px #000dff, 507px 872px #000dff, 466px 3576px #000dff, 430px 1799px #000dff, 1368px 3412px #000dff, 26px 1143px #000dff, 1970px 757px #000dff, 25px 923px #000dff, 1343px 3301px #000dff, 1844px 1001px #000dff, 1915px 3917px #000dff, 598px 3047px #000dff, 738px 2807px #000dff, 2271px 3550px #000dff, 232px 1403px #000dff, 2218px 2806px #000dff, 1391px 2726px #000dff, 49px 2773px #000dff, 2373px 2991px #000dff, 1706px 1088px #000dff, 446px 2430px #000dff, 534px 2904px #000dff, 1193px 1032px #000dff, 2493px 12px #000dff, 1801px 2174px #000dff, 1258px 342px #000dff, 126px 3521px #000dff, 517px 13px #000dff, 1921px 875px #000dff, 1805px 3084px #000dff, 1403px 2008px #000dff, 796px 1374px #000dff, 80px 2645px #000dff, 1535px 431px #000dff, 1281px 463px #000dff, 158px 1198px #000dff, 2390px 3812px #000dff, 619px 2068px #000dff, 487px 3131px #000dff, 597px 2880px #000dff, 2190px 1790px #000dff, 722px 3497px #000dff, 20px 2337px #000dff, 1497px 3269px #000dff, 2193px 1756px #000dff, 1086px 2897px #000dff, 937px 1038px #000dff, 1968px 1711px #000dff, 96px 2557px #000dff, 570px 905px #000dff, 333px 1143px #000dff, 1451px 3088px #000dff, 1702px 2830px #000dff, 1454px 658px #000dff, 676px 3002px #000dff, 165px 15px #000dff, 473px 1808px #000dff, 2076px 1690px #000dff, 945px 1982px #000dff, 991px 395px #000dff, 309px 1953px #000dff, 1156px 2067px #000dff, 1068px 2717px #000dff, 1343px 993px #000dff, 577px 3966px #000dff, 1886px 330px #000dff, 284px 621px #000dff, 2084px 2990px #000dff, 939px 1848px #000dff, 2450px 1080px #000dff, 2418px 3746px #000dff, 209px 1195px #000dff, 860px 1425px #000dff, 57px 3562px #000dff, 113px 720px #000dff, 1515px 1400px #000dff, 1192px 1933px #000dff, 174px 1190px #000dff, 450px 2618px #000dff, 587px 918px #000dff, 240px 648px #000dff, 591px 3153px #000dff, 1612px 2705px #000dff, 326px 641px #000dff, 342px 1080px #000dff, 1738px 2936px #000dff, 1802px 143px #000dff, 1378px 753px #000dff, 1821px 14px #000dff, 618px 889px #000dff, 2047px 2082px #000dff, 325px 1303px #000dff, 2130px 1326px #000dff, 286px 1950px #000dff, 215px 913px #000dff, 2086px 349px #000dff, 1366px 248px #000dff, 349px 936px #000dff, 1481px 1604px #000dff, 1262px 723px #000dff, 744px 2871px #000dff, 48px 1586px #000dff, 2150px 1903px #000dff, 183px 1983px #000dff, 2364px 2238px #000dff, 188px 3962px #000dff, 813px 1423px #000dff, 777px 1468px #000dff, 276px 2399px #000dff, 1935px 2185px #000dff, 1398px 1497px #000dff, 273px 2352px #000dff, 2322px 469px #000dff, 1220px 331px #000dff, 2389px 305px #000dff, 743px 3662px #000dff, 2207px 3135px #000dff, 1276px 3969px #000dff, 1266px 206px #000dff, 127px 3750px #000dff, 1241px 938px #000dff, 510px 1737px #000dff, 1480px 1664px #000dff, 627px 3717px #000dff, 1492px 3192px #000dff, 2163px 27px #000dff, 1507px 2464px #000dff, 357px 3157px #000dff, 1621px 3766px #000dff, 1091px 2943px #000dff, 1565px 1255px #000dff, 1498px 2543px #000dff, 1124px 2675px #000dff, 603px 2810px #000dff, 2461px 81px #000dff, 1689px 2695px #000dff, 1613px 824px #000dff, 606px 3019px #000dff, 1925px 2896px #000dff, 2288px 2449px #000dff, 2326px 3315px #000dff, 784px 3761px #000dff, 725px 1928px #000dff, 1300px 709px #000dff, 2376px 3371px #000dff, 1995px 1201px #000dff, 1347px 1433px #000dff, 578px 1602px #000dff, 1080px 3411px #000dff, 55px 1539px #000dff, 1294px 373px #000dff, 879px 600px #000dff, 2462px 1937px #000dff, 79px 3460px #000dff, 576px 1744px #000dff, 758px 625px #000dff, 2404px 409px #000dff, 1928px 3821px #000dff, 1945px 983px #000dff, 1431px 2036px #000dff, 446px 3412px #000dff, 2404px 1757px #000dff, 2042px 548px #000dff, 1786px 2193px #000dff, 653px 18px #000dff, 2489px 1596px #000dff, 26px 3462px #000dff, 312px 908px #000dff, 1007px 2300px #000dff, 1721px 2314px #000dff, 974px 1348px #000dff, 1333px 2154px #000dff, 397px 3596px #000dff, 186px 3852px #000dff, 1112px 1032px #000dff, 1601px 2132px #000dff, 785px 2613px #000dff, 1199px 3150px #000dff, 1389px 394px #000dff, 1354px 967px #000dff, 1358px 1031px #000dff, 188px 3451px #000dff, 651px 1525px #000dff, 1424px 1814px #000dff, 2224px 3570px #000dff, 851px 1138px #000dff, 204px 1392px #000dff, 1916px 2367px #000dff, 1883px 1664px #000dff, 131px 74px #000dff, 2374px 2653px #000dff, 744px 721px #000dff, 88px 2709px #000dff, 1048px 1973px #000dff, 402px 1476px #000dff, 657px 26px #000dff, 179px 2853px #000dff, 1651px 2521px #000dff, 2398px 1302px #000dff, 1286px 3985px #000dff, 2356px 3577px #000dff, 2423px 880px #000dff, 1187px 3629px #000dff, 879px 2568px #000dff, 1140px 1501px #000dff, 1204px 3529px #000dff, 2215px 386px #000dff, 1637px 622px #000dff, 60px 3372px #000dff, 2339px 520px #000dff, 2406px 1011px #000dff, 1081px 2909px #000dff, 736px 2664px #000dff, 1544px 2828px #000dff, 2077px 2443px #000dff, 1669px 3259px #000dff, 622px 1786px #000dff, 44px 741px #000dff, 1803px 2201px #000dff, 988px 2621px #000dff, 2067px 2073px #000dff, 356px 2141px #000dff, 2267px 353px #000dff, 2115px 2017px #000dff, 860px 3190px #000dff, 1454px 2887px #000dff, 956px 897px #000dff, 1750px 1598px #000dff, 47px 3504px #000dff, 1691px 2135px #000dff, 1616px 2513px #000dff, 555px 3997px #000dff, 1715px 211px #000dff, 2026px 100px #000dff, 413px 2553px #000dff, 2463px 628px #000dff, 831px 3407px #000dff, 369px 2888px #000dff, 1087px 383px #000dff, 543px 1909px #000dff, 1447px 531px #000dff, 554px 1006px #000dff, 2261px 770px #000dff, 1229px 2442px #000dff, 725px 767px #000dff, 574px 2860px #000dff, 1499px 471px #000dff, 1988px 1219px #000dff, 1637px 2137px #000dff, 66px 2712px #000dff, 1441px 1129px #000dff, 2276px 3345px #000dff, 485px 1035px #000dff, 1954px 397px #000dff, 390px 956px #000dff, 368px 3527px #000dff, 2291px 2057px #000dff, 2342px 3357px #000dff, 960px 3288px #000dff, 897px 638px #000dff, 1340px 3665px #000dff, 511px 749px #000dff, 161px 146px #000dff, 447px 1037px #000dff, 186px 3202px #000dff, 119px 478px #000dff, 1744px 986px #000dff, 1868px 3224px #000dff, 265px 1132px #000dff, 982px 809px #000dff, 2174px 1637px #000dff, 2125px 1253px #000dff, 389px 3982px #000dff;
    }

    .stars-background.big {
        width: 2px;
        height: 2px;
        box-shadow: 62px 2151px #000dff, 608px 570px #000dff, 782px 1213px #000dff, 658px 828px #000dff, 356px 2227px #000dff, 1448px 3807px #000dff, 1055px 1601px #000dff, 125px 2041px #000dff, 1190px 2177px #000dff, 1888px 853px #000dff, 895px 2837px #000dff, 1017px 2258px #000dff, 1049px 525px #000dff, 1303px 3776px #000dff, 2327px 3804px #000dff, 343px 1639px #000dff, 525px 3858px #000dff, 2190px 3962px #000dff, 259px 896px #000dff, 2337px 408px #000dff, 1369px 2064px #000dff, 1284px 3323px #000dff, 451px 3498px #000dff, 1853px 3383px #000dff, 2136px 2703px #000dff, 373px 851px #000dff, 1234px 2901px #000dff, 1957px 3894px #000dff, 528px 3630px #000dff, 2003px 3828px #000dff, 1671px 1111px #000dff, 999px 3507px #000dff, 1568px 3086px #000dff, 417px 3517px #000dff, 683px 291px #000dff, 473px 2283px #000dff, 2381px 95px #000dff, 1446px 1061px #000dff, 2261px 2203px #000dff, 634px 1411px #000dff, 1922px 1478px #000dff, 1402px 2791px #000dff, 1186px 373px #000dff, 1100px 3212px #000dff, 325px 995px #000dff, 1384px 2311px #000dff, 2410px 1233px #000dff, 2418px 2446px #000dff, 484px 3483px #000dff, 2433px 3112px #000dff, 594px 3871px #000dff, 62px 3664px #000dff, 1680px 2929px #000dff, 1349px 1410px #000dff, 2071px 160px #000dff, 424px 3296px #000dff, 1612px 3521px #000dff, 2286px 2954px #000dff, 752px 3443px #000dff, 121px 1718px #000dff, 1218px 2280px #000dff, 526px 981px #000dff, 2457px 1457px #000dff, 2240px 1318px #000dff, 1251px 2274px #000dff, 1614px 1897px #000dff, 1737px 3816px #000dff, 1384px 1095px #000dff, 1200px 2706px #000dff, 68px 12px #000dff, 10px 32px #000dff, 2124px 1789px #000dff, 79px 3174px #000dff, 1093px 209px #000dff, 122px 4000px #000dff, 1142px 2106px #000dff, 1994px 3383px #000dff, 1760px 189px #000dff, 926px 1634px #000dff, 2074px 1506px #000dff, 2063px 2153px #000dff, 1782px 2816px #000dff, 942px 2257px #000dff, 2354px 3839px #000dff, 216px 538px #000dff, 285px 1094px #000dff, 2270px 763px #000dff, 2046px 3815px #000dff, 2200px 778px #000dff, 823px 1652px #000dff, 1703px 2123px #000dff, 210px 204px #000dff, 665px 467px #000dff, 167px 174px #000dff, 2422px 124px #000dff, 1377px 811px #000dff, 1262px 2124px #000dff, 9px 2639px #000dff, 386px 2614px #000dff, 702px 1633px #000dff, 1562px 2199px #000dff, 383px 1224px #000dff, 624px 2787px #000dff, 247px 2842px #000dff, 1781px 2157px #000dff, 978px 337px #000dff, 1702px 110px #000dff, 1867px 3220px #000dff, 1360px 150px #000dff, 1902px 371px #000dff, 2047px 634px #000dff, 388px 2230px #000dff, 1300px 1857px #000dff, 348px 1316px #000dff, 300px 3905px #000dff, 1383px 1033px #000dff, 1524px 1082px #000dff, 833px 3809px #000dff, 1709px 2300px #000dff, 2232px 2281px #000dff, 944px 1298px #000dff, 84px 1342px #000dff, 942px 3979px #000dff, 1226px 1215px #000dff, 689px 2053px #000dff, 279px 3874px #000dff, 294px 28px #000dff, 1442px 1339px #000dff, 958px 3460px #000dff, 1620px 496px #000dff, 1462px 2633px #000dff, 309px 107px #000dff, 213px 2305px #000dff, 1963px 2388px #000dff, 339px 2465px #000dff, 352px 2464px #000dff, 566px 3858px #000dff, 239px 3820px #000dff, 1194px 858px #000dff, 1905px 2273px #000dff, 741px 1804px #000dff, 310px 1665px #000dff, 2318px 2130px #000dff, 1382px 466px #000dff, 286px 2448px #000dff, 622px 3109px #000dff, 1576px 930px #000dff, 1441px 1932px #000dff, 1610px 2px #000dff, 1060px 3068px #000dff, 1503px 3604px #000dff, 2077px 2301px #000dff, 1697px 1263px #000dff, 270px 3612px #000dff, 564px 3474px #000dff, 1777px 1925px #000dff, 1076px 379px #000dff, 2146px 1788px #000dff, 256px 2588px #000dff, 1841px 2423px #000dff, 2196px 3265px #000dff, 2230px 3112px #000dff, 2024px 163px #000dff, 1199px 1975px #000dff, 902px 435px #000dff, 1257px 2054px #000dff, 16px 3484px #000dff, 592px 238px #000dff, 1015px 2003px #000dff, 2078px 2151px #000dff, 1840px 3176px #000dff, 119px 3499px #000dff, 774px 3315px #000dff, 1716px 3852px #000dff, 2010px 990px #000dff, 1190px 1271px #000dff, 879px 2677px #000dff, 2249px 771px #000dff, 1060px 1254px #000dff, 635px 3785px #000dff, 1678px 3010px #000dff, 1826px 2113px #000dff, 2378px 2493px #000dff, 1874px 2642px #000dff, 995px 1097px #000dff, 1049px 1126px #000dff, 217px 3396px #000dff, 2489px 1487px #000dff, 1436px 2648px #000dff, 1953px 2158px #000dff, 1715px 3251px #000dff, 2059px 289px #000dff, 761px 2388px #000dff, 1888px 3146px #000dff, 661px 2850px #000dff, 208px 230px #000dff, 1297px 2336px #000dff, 1451px 181px #000dff, 1608px 1937px #000dff, 1608px 3646px #000dff;
    }

    @media (min-width: 2500px) {
        .stars-background {
            box-shadow: none !important;
        }
    }

    @keyframes animStar {
        from {
            transform: translateY(0px);
        }

        to {
            transform: translateY(-2000px);
        }
    }

    .stars-background-def {
        border-radius: 100%;
        background: transparent;
        animation: animStar 10s linear infinite;
        position: fixed;
        z-index: -2;
        left: 0;
        top: 0;
    }


    .stars-background-def.medium-def {
        width: 1.5px;
        height: 1.5px;
        box-shadow: 2407px 2944px #FFF, 1900px 2278px #FFF, 458px 3374px #FFF, 832px 158px #FFF, 155px 1606px #FFF, 640px 3725px #FFF, 2055px 3513px #FFF, 1283px 2244px #FFF, 1245px 1230px #FFF, 892px 851px #FFF, 819px 1183px #FFF, 957px 2862px #FFF, 499px 2354px #FFF, 1283px 3570px #FFF, 1980px 3523px #FFF, 39px 1926px #FFF, 305px 704px #FFF, 1788px 3981px #FFF, 2177px 1947px #FFF, 2354px 2109px #FFF, 949px 3782px #FFF, 2411px 3445px #FFF, 107px 1681px #FFF, 1389px 973px #FFF, 1829px 2206px #FFF, 1026px 1695px #FFF, 743px 3508px #FFF, 209px 3941px #FFF, 2248px 2921px #FFF, 2377px 3882px #FFF, 208px 11px #FFF, 1706px 2128px #FFF, 1978px 147px #FFF, 1304px 2228px #FFF, 350px 3615px #FFF, 2195px 1730px #FFF, 664px 1226px #FFF, 1932px 252px #FFF, 1435px 2865px #FFF, 1766px 1339px #FFF, 314px 14px #FFF, 1055px 2726px #FFF, 40px 1080px #FFF, 113px 2950px #FFF, 2076px 3152px #FFF, 1052px 628px #FFF, 112px 1072px #FFF, 1337px 3951px #FFF, 700px 3118px #FFF, 1567px 310px #FFF, 742px 2807px #FFF, 11px 1376px #FFF, 1769px 1148px #FFF, 670px 212px #FFF, 1850px 3606px #FFF, 1694px 3192px #FFF, 599px 634px #FFF, 238px 3646px #FFF, 1229px 149px #FFF, 772px 3719px #FFF, 2436px 735px #FFF, 2115px 2394px #FFF, 805px 2392px #FFF, 942px 2368px #FFF, 2423px 3545px #FFF, 872px 1344px #FFF, 1720px 66px #FFF, 638px 2840px #FFF, 1980px 355px #FFF, 881px 1932px #FFF, 2178px 1196px #FFF, 191px 334px #FFF, 1673px 2253px #FFF, 161px 1454px #FFF, 71px 2880px #FFF, 129px 723px #FFF, 2169px 322px #FFF, 1030px 2566px #FFF, 636px 1669px #FFF, 662px 1698px #FFF, 1511px 1849px #FFF, 1114px 3808px #FFF, 933px 3056px #FFF, 857px 2617px #FFF, 9px 2801px #FFF, 1178px 125px #FFF, 1766px 3693px #FFF, 502px 1889px #FFF, 2371px 1857px #FFF, 2288px 3968px #FFF, 27px 2791px #FFF, 1469px 2562px #FFF, 832px 3823px #FFF, 768px 1851px #FFF, 997px 3214px #FFF, 1139px 3630px #FFF, 1533px 3410px #FFF, 981px 1473px #FFF, 989px 1739px #FFF, 2298px 2257px #FFF, 1577px 1332px #FFF, 145px 1124px #FFF, 468px 2706px #FFF, 1183px 338px #FFF, 1247px 3699px #FFF, 921px 2965px #FFF, 2448px 346px #FFF, 1238px 2756px #FFF, 244px 168px #FFF, 1154px 2772px #FFF, 1839px 2194px #FFF, 363px 3953px #FFF, 908px 2816px #FFF, 808px 2976px #FFF, 790px 239px #FFF, 1952px 1386px #FFF, 1082px 3404px #FFF, 827px 952px #FFF, 7px 3185px #FFF, 917px 823px #FFF, 70px 2103px #FFF, 1248px 1311px #FFF, 1476px 367px #FFF, 2363px 2713px #FFF, 830px 184px #FFF, 207px 1708px #FFF, 1942px 1800px #FFF, 1560px 2035px #FFF, 1042px 1086px #FFF, 1093px 24px #FFF, 1313px 1703px #FFF, 966px 1423px #FFF, 1665px 3139px #FFF, 427px 1344px #FFF, 134px 2736px #FFF, 618px 3477px #FFF, 912px 3443px #FFF, 328px 871px #FFF, 376px 1116px #FFF, 172px 3721px #FFF, 2363px 1535px #FFF, 247px 3408px #FFF, 186px 1991px #FFF, 1845px 1490px #FFF, 2299px 455px #FFF, 2409px 2395px #FFF, 1828px 1819px #FFF, 511px 1549px #FFF, 93px 496px #FFF, 1835px 2504px #FFF, 2309px 3411px #FFF, 698px 3749px #FFF, 2199px 1466px #FFF, 1513px 644px #FFF, 1975px 1109px #FFF, 1836px 3998px #FFF, 984px 3853px #FFF, 244px 1285px #FFF, 1062px 2924px #FFF, 437px 2283px #FFF, 275px 2991px #FFF, 349px 1371px #FFF, 2337px 3402px #FFF, 304px 947px #FFF, 88px 894px #FFF, 1287px 743px #FFF, 1008px 1456px #FFF, 1306px 3930px #FFF, 2177px 164px #FFF, 683px 3795px #FFF, 229px 3507px #FFF, 1277px 3660px #FFF, 1703px 334px #FFF, 1467px 3793px #FFF, 2037px 922px #FFF, 1953px 880px #FFF, 414px 959px #FFF, 1161px 1577px #FFF, 822px 697px #FFF, 246px 870px #FFF, 1253px 1915px #FFF, 1127px 3000px #FFF, 722px 733px #FFF, 393px 1039px #FFF, 551px 2435px #FFF, 2238px 2216px #FFF, 263px 241px #FFF, 146px 2025px #FFF, 683px 3656px #FFF, 1896px 478px #FFF, 1353px 3574px #FFF, 2155px 3636px #FFF, 655px 76px #FFF, 1391px 1584px #FFF, 1587px 2474px #FFF, 284px 3844px #FFF, 32px 3535px #FFF, 840px 1374px #FFF, 410px 1523px #FFF, 2441px 1910px #FFF, 149px 973px #FFF, 203px 1862px #FFF, 2312px 1681px #FFF, 138px 173px #FFF, 615px 928px #FFF, 441px 2129px #FFF, 1585px 2451px #FFF, 1210px 2098px #FFF, 968px 2387px #FFF, 333px 3267px #FFF, 2100px 3580px #FFF, 613px 1797px #FFF, 1022px 1835px #FFF, 1772px 1692px #FFF, 464px 2908px #FFF, 1540px 1752px #FFF, 2153px 3521px #FFF, 1156px 2938px #FFF, 1250px 3128px #FFF, 880px 3443px #FFF, 2172px 1448px #FFF, 1170px 2214px #FFF, 646px 395px #FFF, 1823px 548px #FFF, 1392px 532px #FFF, 2306px 1978px #FFF, 1518px 3595px #FFF, 2496px 3347px #FFF, 507px 872px #FFF, 466px 3576px #FFF, 430px 1799px #FFF, 1368px 3412px #FFF, 26px 1143px #FFF, 1970px 757px #FFF, 25px 923px #FFF, 1343px 3301px #FFF, 1844px 1001px #FFF, 1915px 3917px #FFF, 598px 3047px #FFF, 738px 2807px #FFF, 2271px 3550px #FFF, 232px 1403px #FFF, 2218px 2806px #FFF, 1391px 2726px #FFF, 49px 2773px #FFF, 2373px 2991px #FFF, 1706px 1088px #FFF, 446px 2430px #FFF, 534px 2904px #FFF, 1193px 1032px #FFF, 2493px 12px #FFF, 1801px 2174px #FFF, 1258px 342px #FFF, 126px 3521px #FFF, 517px 13px #FFF, 1921px 875px #FFF, 1805px 3084px #FFF, 1403px 2008px #FFF, 796px 1374px #FFF, 80px 2645px #FFF, 1535px 431px #FFF, 1281px 463px #FFF, 158px 1198px #FFF, 2390px 3812px #FFF, 619px 2068px #FFF, 487px 3131px #FFF, 597px 2880px #FFF, 2190px 1790px #FFF, 722px 3497px #FFF, 20px 2337px #FFF, 1497px 3269px #FFF, 2193px 1756px #FFF, 1086px 2897px #FFF, 937px 1038px #FFF, 1968px 1711px #FFF, 96px 2557px #FFF, 570px 905px #FFF, 333px 1143px #FFF, 1451px 3088px #FFF, 1702px 2830px #FFF, 1454px 658px #FFF, 676px 3002px #FFF, 165px 15px #FFF, 473px 1808px #FFF, 2076px 1690px #FFF, 945px 1982px #FFF, 991px 395px #FFF, 309px 1953px #FFF, 1156px 2067px #FFF, 1068px 2717px #FFF, 1343px 993px #FFF, 577px 3966px #FFF, 1886px 330px #FFF, 284px 621px #FFF, 2084px 2990px #FFF, 939px 1848px #FFF, 2450px 1080px #FFF, 2418px 3746px #FFF, 209px 1195px #FFF, 860px 1425px #FFF, 57px 3562px #FFF, 113px 720px #FFF, 1515px 1400px #FFF, 1192px 1933px #FFF, 174px 1190px #FFF, 450px 2618px #FFF, 587px 918px #FFF, 240px 648px #FFF, 591px 3153px #FFF, 1612px 2705px #FFF, 326px 641px #FFF, 342px 1080px #FFF, 1738px 2936px #FFF, 1802px 143px #FFF, 1378px 753px #FFF, 1821px 14px #FFF, 618px 889px #FFF, 2047px 2082px #FFF, 325px 1303px #FFF, 2130px 1326px #FFF, 286px 1950px #FFF, 215px 913px #FFF, 2086px 349px #FFF, 1366px 248px #FFF, 349px 936px #FFF, 1481px 1604px #FFF, 1262px 723px #FFF, 744px 2871px #FFF, 48px 1586px #FFF, 2150px 1903px #FFF, 183px 1983px #FFF, 2364px 2238px #FFF, 188px 3962px #FFF, 813px 1423px #FFF, 777px 1468px #FFF, 276px 2399px #FFF, 1935px 2185px #FFF, 1398px 1497px #FFF, 273px 2352px #FFF, 2322px 469px #FFF, 1220px 331px #FFF, 2389px 305px #FFF, 743px 3662px #FFF, 2207px 3135px #FFF, 1276px 3969px #FFF, 1266px 206px #FFF, 127px 3750px #FFF, 1241px 938px #FFF, 510px 1737px #FFF, 1480px 1664px #FFF, 627px 3717px #FFF, 1492px 3192px #FFF, 2163px 27px #FFF, 1507px 2464px #FFF, 357px 3157px #FFF, 1621px 3766px #FFF, 1091px 2943px #FFF, 1565px 1255px #FFF, 1498px 2543px #FFF, 1124px 2675px #FFF, 603px 2810px #FFF, 2461px 81px #FFF, 1689px 2695px #FFF, 1613px 824px #FFF, 606px 3019px #FFF, 1925px 2896px #FFF, 2288px 2449px #FFF, 2326px 3315px #FFF, 784px 3761px #FFF, 725px 1928px #FFF, 1300px 709px #FFF, 2376px 3371px #FFF, 1995px 1201px #FFF, 1347px 1433px #FFF, 578px 1602px #FFF, 1080px 3411px #FFF, 55px 1539px #FFF, 1294px 373px #FFF, 879px 600px #FFF, 2462px 1937px #FFF, 79px 3460px #FFF, 576px 1744px #FFF, 758px 625px #FFF, 2404px 409px #FFF, 1928px 3821px #FFF, 1945px 983px #FFF, 1431px 2036px #FFF, 446px 3412px #FFF, 2404px 1757px #FFF, 2042px 548px #FFF, 1786px 2193px #FFF, 653px 18px #FFF, 2489px 1596px #FFF, 26px 3462px #FFF, 312px 908px #FFF, 1007px 2300px #FFF, 1721px 2314px #FFF, 974px 1348px #FFF, 1333px 2154px #FFF, 397px 3596px #FFF, 186px 3852px #FFF, 1112px 1032px #FFF, 1601px 2132px #FFF, 785px 2613px #FFF, 1199px 3150px #FFF, 1389px 394px #FFF, 1354px 967px #FFF, 1358px 1031px #FFF, 188px 3451px #FFF, 651px 1525px #FFF, 1424px 1814px #FFF, 2224px 3570px #FFF, 851px 1138px #FFF, 204px 1392px #FFF, 1916px 2367px #FFF, 1883px 1664px #FFF, 131px 74px #FFF, 2374px 2653px #FFF, 744px 721px #FFF, 88px 2709px #FFF, 1048px 1973px #FFF, 402px 1476px #FFF, 657px 26px #FFF, 179px 2853px #FFF, 1651px 2521px #FFF, 2398px 1302px #FFF, 1286px 3985px #FFF, 2356px 3577px #FFF, 2423px 880px #FFF, 1187px 3629px #FFF, 879px 2568px #FFF, 1140px 1501px #FFF, 1204px 3529px #FFF, 2215px 386px #FFF, 1637px 622px #FFF, 60px 3372px #FFF, 2339px 520px #FFF, 2406px 1011px #FFF, 1081px 2909px #FFF, 736px 2664px #FFF, 1544px 2828px #FFF, 2077px 2443px #FFF, 1669px 3259px #FFF, 622px 1786px #FFF, 44px 741px #FFF, 1803px 2201px #FFF, 988px 2621px #FFF, 2067px 2073px #FFF, 356px 2141px #FFF, 2267px 353px #FFF, 2115px 2017px #FFF, 860px 3190px #FFF, 1454px 2887px #FFF, 956px 897px #FFF, 1750px 1598px #FFF, 47px 3504px #FFF, 1691px 2135px #FFF, 1616px 2513px #FFF, 555px 3997px #FFF, 1715px 211px #FFF, 2026px 100px #FFF, 413px 2553px #FFF, 2463px 628px #FFF, 831px 3407px #FFF, 369px 2888px #FFF, 1087px 383px #FFF, 543px 1909px #FFF, 1447px 531px #FFF, 554px 1006px #FFF, 2261px 770px #FFF, 1229px 2442px #FFF, 725px 767px #FFF, 574px 2860px #FFF, 1499px 471px #FFF, 1988px 1219px #FFF, 1637px 2137px #FFF, 66px 2712px #FFF, 1441px 1129px #FFF, 2276px 3345px #FFF, 485px 1035px #FFF, 1954px 397px #FFF, 390px 956px #FFF, 368px 3527px #FFF, 2291px 2057px #FFF, 2342px 3357px #FFF, 960px 3288px #FFF, 897px 638px #FFF, 1340px 3665px #FFF, 511px 749px #FFF, 161px 146px #FFF, 447px 1037px #FFF, 186px 3202px #FFF, 119px 478px #FFF, 1744px 986px #FFF, 1868px 3224px #FFF, 265px 1132px #FFF, 982px 809px #FFF, 2174px 1637px #FFF, 2125px 1253px #FFF, 389px 3982px #FFF;
    }

    .stars-background-def.big-def {
        width: 2px;
        height: 2px;
        box-shadow: 62px 2151px #FFF, 608px 570px #FFF, 782px 1213px #FFF, 658px 828px #FFF, 356px 2227px #FFF, 1448px 3807px #FFF, 1055px 1601px #FFF, 125px 2041px #FFF, 1190px 2177px #FFF, 1888px 853px #FFF, 895px 2837px #FFF, 1017px 2258px #FFF, 1049px 525px #FFF, 1303px 3776px #FFF, 2327px 3804px #FFF, 343px 1639px #FFF, 525px 3858px #FFF, 2190px 3962px #FFF, 259px 896px #FFF, 2337px 408px #FFF, 1369px 2064px #FFF, 1284px 3323px #FFF, 451px 3498px #FFF, 1853px 3383px #FFF, 2136px 2703px #FFF, 373px 851px #FFF, 1234px 2901px #FFF, 1957px 3894px #FFF, 528px 3630px #FFF, 2003px 3828px #FFF, 1671px 1111px #FFF, 999px 3507px #FFF, 1568px 3086px #FFF, 417px 3517px #FFF, 683px 291px #FFF, 473px 2283px #FFF, 2381px 95px #FFF, 1446px 1061px #FFF, 2261px 2203px #FFF, 634px 1411px #FFF, 1922px 1478px #FFF, 1402px 2791px #FFF, 1186px 373px #FFF, 1100px 3212px #FFF, 325px 995px #FFF, 1384px 2311px #FFF, 2410px 1233px #FFF, 2418px 2446px #FFF, 484px 3483px #FFF, 2433px 3112px #FFF, 594px 3871px #FFF, 62px 3664px #FFF, 1680px 2929px #FFF, 1349px 1410px #FFF, 2071px 160px #FFF, 424px 3296px #FFF, 1612px 3521px #FFF, 2286px 2954px #FFF, 752px 3443px #FFF, 121px 1718px #FFF, 1218px 2280px #FFF, 526px 981px #FFF, 2457px 1457px #FFF, 2240px 1318px #FFF, 1251px 2274px #FFF, 1614px 1897px #FFF, 1737px 3816px #FFF, 1384px 1095px #FFF, 1200px 2706px #FFF, 68px 12px #FFF, 10px 32px #FFF, 2124px 1789px #FFF, 79px 3174px #FFF, 1093px 209px #FFF, 122px 4000px #FFF, 1142px 2106px #FFF, 1994px 3383px #FFF, 1760px 189px #FFF, 926px 1634px #FFF, 2074px 1506px #FFF, 2063px 2153px #FFF, 1782px 2816px #FFF, 942px 2257px #FFF, 2354px 3839px #FFF, 216px 538px #FFF, 285px 1094px #FFF, 2270px 763px #FFF, 2046px 3815px #FFF, 2200px 778px #FFF, 823px 1652px #FFF, 1703px 2123px #FFF, 210px 204px #FFF, 665px 467px #FFF, 167px 174px #FFF, 2422px 124px #FFF, 1377px 811px #FFF, 1262px 2124px #FFF, 9px 2639px #FFF, 386px 2614px #FFF, 702px 1633px #FFF, 1562px 2199px #FFF, 383px 1224px #FFF, 624px 2787px #FFF, 247px 2842px #FFF, 1781px 2157px #FFF, 978px 337px #FFF, 1702px 110px #FFF, 1867px 3220px #FFF, 1360px 150px #FFF, 1902px 371px #FFF, 2047px 634px #FFF, 388px 2230px #FFF, 1300px 1857px #FFF, 348px 1316px #FFF, 300px 3905px #FFF, 1383px 1033px #FFF, 1524px 1082px #FFF, 833px 3809px #FFF, 1709px 2300px #FFF, 2232px 2281px #FFF, 944px 1298px #FFF, 84px 1342px #FFF, 942px 3979px #FFF, 1226px 1215px #FFF, 689px 2053px #FFF, 279px 3874px #FFF, 294px 28px #FFF, 1442px 1339px #FFF, 958px 3460px #FFF, 1620px 496px #FFF, 1462px 2633px #FFF, 309px 107px #FFF, 213px 2305px #FFF, 1963px 2388px #FFF, 339px 2465px #FFF, 352px 2464px #FFF, 566px 3858px #FFF, 239px 3820px #FFF, 1194px 858px #FFF, 1905px 2273px #FFF, 741px 1804px #FFF, 310px 1665px #FFF, 2318px 2130px #FFF, 1382px 466px #FFF, 286px 2448px #FFF, 622px 3109px #FFF, 1576px 930px #FFF, 1441px 1932px #FFF, 1610px 2px #FFF, 1060px 3068px #FFF, 1503px 3604px #FFF, 2077px 2301px #FFF, 1697px 1263px #FFF, 270px 3612px #FFF, 564px 3474px #FFF, 1777px 1925px #FFF, 1076px 379px #FFF, 2146px 1788px #FFF, 256px 2588px #FFF, 1841px 2423px #FFF, 2196px 3265px #FFF, 2230px 3112px #FFF, 2024px 163px #FFF, 1199px 1975px #FFF, 902px 435px #FFF, 1257px 2054px #FFF, 16px 3484px #FFF, 592px 238px #FFF, 1015px 2003px #FFF, 2078px 2151px #FFF, 1840px 3176px #FFF, 119px 3499px #FFF, 774px 3315px #FFF, 1716px 3852px #FFF, 2010px 990px #FFF, 1190px 1271px #FFF, 879px 2677px #FFF, 2249px 771px #FFF, 1060px 1254px #FFF, 635px 3785px #FFF, 1678px 3010px #FFF, 1826px 2113px #FFF, 2378px 2493px #FFF, 1874px 2642px #FFF, 995px 1097px #FFF, 1049px 1126px #FFF, 217px 3396px #FFF, 2489px 1487px #FFF, 1436px 2648px #FFF, 1953px 2158px #FFF, 1715px 3251px #FFF, 2059px 289px #FFF, 761px 2388px #FFF, 1888px 3146px #FFF, 661px 2850px #FFF, 208px 230px #FFF, 1297px 2336px #FFF, 1451px 181px #FFF, 1608px 1937px #FFF, 1608px 3646px #FFF;
    }

    @media (min-width: 2500px) {
        .stars-background-def {
            box-shadow: none !important;
        }
    }

    @keyframes animStar {
        from {
            transform: translateY(0px);
        }

        to {
            transform: translateY(-2000px);
        }
    }
</style>
</head>
<body>

<nav class="bg-gray-800 text-white p-3" style="background-color: #1e1e1f !important; ">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/" class="flex items-center">
                <img src="./images/paste_logo.png" alt="Logo" class="mr-2" style="width: 50px !important; height: auto;"> 
            </a>
        </div>

        <div class="hidden md:flex grow justify-center" style="gap: 40px;">
    <b>
        <a href="index.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Create Paste</a>
        <a href="recent.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Recent Page</a>
        <a href="top.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Top Paste</a>
    </b>
</div>


        <div class="flex items-center">
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="/pastyy_site/user/dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Dashboard</a>
                <a href="../user/logout" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block ml-2">Log out</a>
            <?php else: ?>
                <a href="../user/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Login</a>
                <span class="mx-2 hidden md:block">or</span>
                <a href="./user/register.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hidden md:block">Register</a>
                <button class="mobile-menu-button md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="mobile-menu hidden md:hidden p-4 text-center">
    <a href="../create.php" class="block hover:text-gray-300 mb-2">Create Paste</a>
    <a href="../recent.php" class="block hover:text-gray-300 mb-2">Recent Page</a>
    <a href="../top.php" class="block hover:text-gray-300 mb-4">Top Paste</a>
    <a href="../top.php" class="hover:text-gray-300" style="margin-right: 20px !important;">Paste Events</a>
    <?php if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
        <div class="flex justify-center space-x-2">
            <a href="./user/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
            <span class="text-white">or</span>
            <a href="/../user/register.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</a>
        </div>
    <?php endif; ?>
</div>

</nav>


<?php

$sql = "SELECT * FROM site_settings WHERE id = 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $theme = $row['theme'];
} else {
    $theme = null;
}




if ($theme == 1)
{
    echo '<div class="stars-background-def small-def"></div>
    <div class="stars-background-def medium-def"></div>
    <div class="stars-background-def big-def"></div>';
}
else if ($theme == 2)
{
  echo '
  <div id="stars"></div>
  <div class="moon">
    </div>
  <div class="cloud"></div>
  
  <img src="https://i.imgur.com/EtCPE3S.png" class="spider">
    <div class="cloud2"></div>
        <div id="starContainer"></div>
  <div class="snowflakes">
  <div class="snowflake">
 <img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>	
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
  <div class="snowflake">
  <img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" />   </div>
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>	
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>	
  <div class="snowflake">
<img src="https://media1.giphy.com/media/0xR7MUO0hJfWtco7C6/giphy.gif" /> 
  </div>
</div>   <img src="https://i.imgur.com/EtCPE3S.png" class="spider">

';
}

else if ($theme == 3)
{
    echo '<div id="stars"></div><canvas id="canvas"></canvas>'; 
}

else if ($theme == 4)
{
  echo '<div class="stars-background small"></div>
  <div class="stars-background medium"></div>
  <div class="stars-background big"></div>';
}





$backgroundUrl = '';

$sql = "SELECT background_url FROM site_settings WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $backgroundUrl = $row['background_url'];



}


if ($theme == 5 && !empty($backgroundUrl)) : ?>
  <style>
    body {
        background-image: url('<?php echo htmlspecialchars($backgroundUrl); ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .header_section {
      background-color: transparent !important;
    }

  </style>
<?php endif; ?>



<script>
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.toggle('hidden');
    });
</script>
<script src="https://unpkg.com/@tailwindcss"></script>
<style>





canvas {
  width: 100vw;
  height: 100vh;
  position: absolute;
  top: 0;
  left: 0;
  pointer-events: none; /* Add this line */
}


.spider {
	position: absolute;
	top: 0;
	animation: animateSpider 15s ease-in-out infinite;
    color: black;
}
@keyframes animateSpider {
	0%,100%
	{
		transform: translateY(-500px);
	}
	50% 
	{
		transform: translateY(0px);
	}
}
.pumpkin01 {
	position: absolute;
	top: 100px;
	right: 200px;
	animation: animatePumpkin 8s ease-in-out infinite;
}
.pumpkin02 {
	position: absolute;
	bottom: 20px;
	left: 50px;
	scale: 0.5;
	animation: animatePumpkin 4s ease-in-out infinite;
}

@keyframes animatePumpkin {
	0%,100% 
	{
		transform: translateY(-50px);
	}
	50% 
	{
		transform: translateY(50px);
	}
}
.spiderWeb {
	position: absolute;
	width: 100%;
	height: 100%;
	object-fit: cover;
	mix-blend-mode: screen;
}
#stars {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
  }
  
  .star {
    position: absolute;
    background-color: #fff;
    width: 1px;
    height: 1px;
    border-radius: 50%;
  }
  
  .star:before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.8);
    opacity: 0;
    animation: starTwinkle 2s infinite;
  }
  
  .shooting-star {
    position: absolute;
    width: 2px;
    height: 10px;
    background-color: #fff;
    opacity: 1;
    z-index: 1;
    transform: rotate(45deg);
    animation: shootingStarAnimation 0.5s linear forwards;
  }
  
  @keyframes starTwinkle {
    0% {
      transform: scale(0.3);
      opacity: 0;
    }
    50% {
      transform: scale(0.5);
      opacity: 1;
    }
    100% {
      transform: scale(0.5);
      opacity: 0;
    }
  }
  
  @keyframes shootingStarAnimation {
    0% {
      opacity: 1;
      transform: translateX(-200px) translateY(-200px) rotate(70deg);
    }
    100% {
      opacity: 0;
      transform: translateX(200px) translateY(-300px) rotate(70deg);
    }
  }

  body 
  {
    overflow-x: hidden; 
  }

  /* Randomized twinkle delays */
.star:nth-child(1):before {
    animation-delay: 0.8s;
  }
  
  .star:nth-child(2):before {
    animation-delay: 1.2s;
  }
  
  .star:nth-child(3):before {
    animation-delay: 0.9s;
  }
  
  .star:nth-child(4):before {
    animation-delay: 1.4s;
  }
  
  .star:nth-child(5):before {
    animation-delay: 1.1s;
  }
  
  .star:nth-child(6):before {
    animation-delay: 0.7s;
  }
  
  /* Add more star:nth-child(n):before rules for additional stars */
  .star:nth-child(7):before {
    animation-delay: 1.3s;
  }
  
  .star:nth-child(8):before {
    animation-delay: 0.6s;
  }
  
  .star:nth-child(9):before {
    animation-delay: 1.5s;
  }
  
  .star:nth-child(10):before {
    animation-delay: 0.5s;
  }
  
  /* Continue adding star:nth-child(n):before rules for more delays */
  .star:nth-child(15):before {
    animation-delay: 0.8s;
  }
  
  .star:nth-child(16):before {
    animation-delay: 1.2s;
  }
  
  .star:nth-child(17):before {
    animation-delay: 0.9s;
  }
  
  .star:nth-child(18):before {
    animation-delay: 1.4s;
  }
  
  .star:nth-child(19):before {
    animation-delay: 1.1s;
  }
  
  .star:nth-child(20):before {
    animation-delay: 0.7s;
  }
  
  /* Add more star:nth-child(n):before rules for additional stars */
  .star:nth-child(11):before {
    animation-delay: 1.3s;
  }
  
  .star:nth-child(12):before {
    animation-delay: 0.6s;
  }
  
  .star:nth-child(13):before {
    animation-delay: 1.5s;
  }
  
  .star:nth-child(14):before {
    animation-delay: 0.5s;
  }
.moon {
  background-color: #f2f0e5;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  position: absolute;
  top: 20px;
  left: 110px;
  box-shadow: 0px 0px 20px 0px rgba(255, 255, 255, 0.75);
  
  &:before, &:after {
    content: "";
    position: absolute;
    background-color: #c3c4c7;
    border-radius: 100%;
  }
  &:before{
    height: 15px;
    width: 15px;
    left: 5px;
    top: 7px;
  }
  &:after{
    height: 7px;
    width: 7px;
    top: 24px;
    left: 15px;
  }
}

.cloud {
  position: absolute;
  top: 35px;
  left: -26px;
  height: 25px;
  width: 50px;
  background-color: white;
  border-radius: 50px 50px 0 0;
  animation: cloudy 20s linear infinite;
  
  &:after {
    content: "";
    position: absolute;
    background-color: white;
    height: 15px;
    width: 30px;
    border-radius: 30px 30px 0 0;
    left: 37px;
    bottom: 0;
  }
}

@keyframes cloudy{
  50% {
    transform: translateX(200px);
  }
}

@keyframes cloudy2{
  50% {
    transform: translateX(-200px);
  }
}

.cloud2{
position: absolute;
  top: 5px;
  right: -26px;
  height: 15px;
  width: 30px;
  background-color: white;
  border-radius: 30px 30px 0 0;
  animation: cloudy2 38s linear infinite;
  
  &:after {
    content: "";
    position: absolute;
    background-color: white;
    height: 7px;
    width: 15px;
    border-radius: 15px 15px 0 0;
    left: -10px;
    bottom: 0;
  }
}

.snowflake {
  color: #fff;
  font-size: 1em;
  font-family: Serif;
  text-shadow: 0 0 1px #000;
}

@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%{-webkit-transform:translateX(0px);transform:translateX(0px)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}100%{-webkit-transform:translateX(0px);transform:translateX(0px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%{transform:translateX(0px)}50%{transform:translateX(80px)}100%{transform:translateX(0px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2s,1s;animation-delay:2s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1s;animation
delay:3s,1s}.snowflake:nth-of-type(10)
/* Demo Purpose Only*/
.demo {
  font-family: 'Raleway', sans-serif;
	color:#fff;
    display: block;
    margin: 0 auto;
    padding: 15px 0;
    text-align: center;
}
.demo a{
  font-family: 'Raleway', sans-serif;
color: #000;		
}

.snowflake img {
    height: 40px;
    bottom: 0;
    background-color: #;
    display: block;

</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const starCount = 45; // Number of stars to create
  const shootingStarInterval = 8000; // Interval between shooting stars in milliseconds

  function createStar() {
    const star = document.createElement("div");
    star.className = "star";
    star.style.top = `${Math.random() * 100}%`;
    star.style.left = `${Math.random() * 100}%`;
    document.getElementById("stars").appendChild(star);
  }

  function createShootingStar() {
    const shootingStar = document.createElement("div");
    shootingStar.className = "shooting-star";
    shootingStar.style.top = `${Math.random() * 100}%`;
    shootingStar.style.left = `${Math.random() * 100}%`;
    document.body.appendChild(shootingStar);
    setTimeout(() => {
      document.body.removeChild(shootingStar);
    }, 3000);
  }

  function generateStars() {
    for (let i = 0; i < starCount; i++) {
      createStar();
    }
  }

  generateStars();
  setTimeout(createShootingStar, Math.random() * shootingStarInterval); // Initial shooting star

  // Randomize shooting star interval
  function randomizeShootingStarInterval() {
    const interval = Math.random() * shootingStarInterval;
    setTimeout(function() {
      createShootingStar();
      randomizeShootingStarInterval();
    }, interval);
  }

  randomizeShootingStarInterval();


  
});

</script>
</body>
</html>
