<?php
    $dataPoints=percentTypeQuestion();
     ?>
     <script>
     window.onload = function() {;
     var chart = new CanvasJS.Chart("chartContainer", {
         animationEnabled: true,
         title: {
             text: "Les types de questions"
         },
         subtitles: [{
             text: "QCM"
         }],
         data: [{
             type: "pie",
             yValueFormatString: "#,##0.00\"%\"",
             indexLabel: "{label} ({y})",
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart.render();
      
     }
     </script>
   <p><br></p>
    
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>
     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                   