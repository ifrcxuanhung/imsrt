<?php echo $list ?>

<script>
jQuery(document).ready(function(){
    function mapper(str)
    {
        var o = {};
        strArr = str.split(":");
        o[strArr[0].trim()] = strArr[1].trim();
        return o;
    }
    $("table.quote_list").attr("id","Khoademo");
    var refTab=document.getElementById("Khoademo");
    //console.log(refTab.rows.length); 
    var  ttl; 
    // Loop through all rows and columns of the table and popup alert with the value 
    var arr = [];
    // /content of each cell. 
    for ( var i = 0; i<refTab.rows.length; i++ ) { 
      var row = refTab.rows.item(i);
      var name = row.cells.item(1).firstChild.innerHTML;
     // var date = row.cells.item(6).firstChild.('attr').innerHTML;
      var datetimes = row.cells.item(6).firstChild.innerHTML;
      //console.log(datetimes);
     
      var last = row.cells.item(2).firstChild.innerHTML;
      var percent = row.cells.item(4).firstChild.innerHTML;
      var change = row.cells.item(5).firstChild.innerHTML;
      var pclose = row.cells.item(3).firstChild.innerHTML;
      //console.log(datetime); 
      var x = [name,datetimes,last,percent,change,pclose];
     
      // console.log(x);
      arr.push(x);  
       

     // for ( var j = 0; j<row.cells.length; j++ ) { 
//        var col = row.cells.item(j);
//        arr.push(i => col.firstChild.innerHTML); 
//      } 
    //console.log(myArray);
    }    
    console.log(arr);
     $.ajax({
        url: $base_url + "download/export",
        type: "POST",
        data: {arr:arr},
        async: false
//        success: function(response) {
//            location.href = response;
//        }
    });
});
</script>