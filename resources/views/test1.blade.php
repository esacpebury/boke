<html>
<title>我是谁</title>
<head>
    <script type="text/javascript">
        function loadXMLDoc() {
            var  xmlhttp;
            if (window.XMLHttpRequest){
                xmlhttp=new XMLHttpRequest();
            } else
            {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function () {
                if (xmlhttp.readyState==4&&xmlhttp.status==200)
                {
                    document.getElementById("mydiv").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET",{{$users}},true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
<p>舱室以诚信啊</p>
<div id="mydiv">点击我弹出信息</div>
<button type="button" onclick="loadXMLDoc()">改变</button>

{{--{{$users}}--}}
{{--{{$admin}}--}}
</body>
</html>