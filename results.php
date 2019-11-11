<html lang="en">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Vibes</title>
        <script src="Th19.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Th19.css">
    </head>
<body onload="getTitle()">
  <script>
      var jsondata;
      let title=window.location.search;
      function getTitle() {
          document.querySelector("#movietitle").innerText="Movie: "+title.replace(/-/g, " ").replace("?title=","");
      }

      $.get("call.php"+title, function(data, status){
        jsondata=JSON.parse(data);
        jsondata=parsesctuff(jsondata);
        parseData(jsondata);
        renderChart();
        document.getElementById("analyzing").style.display = "none";
      });

function parsesctuff(data1){
    var arr = JSON.parse(data1[0])["sentences_tone"];
    var x;
    for(x = 1; x<data1.length; x++){
      arr = arr.concat(JSON.parse(data1[x])["sentences_tone"]);
    }
    return arr;
}

var maga=[], magf=[], magj=[], mags=[], magan=[], magc=[], magt=[];
var magaa=[], magff=[], magjj=[], magss=[], magann=[], magcc=[], magtt=[];
var labels=[];
var labels2=[];
var text=[];
var angerRatio=0, fearRatio=0, joyRatio=0, sadnessRatio=0, analyticalRatio=0, confidentRatio=0, tentativeRatio=0;
function parseData(jsondata){
      let i=-1;
      let atotal=0,ftotal=0, jtotal=0, stotal=0, antotal=0, ctotal=0, ttotal=0;
      for (var key in jsondata) {
        if (jsondata[key]["tones"].length>0) {
          i++;
          var z=0;
          for(let x=0; x<jsondata[key]["tones"].length; x++){
            if(jsondata[key]["tones"][z]<jsondata[key]["tones"][x]){
              z=x;
            }
          }
          switch(jsondata[key]["tones"][z]["tone_id"]){
            case "anger":
                          maga[i]=(jsondata[key]["tones"][z]["score"]);
                          atotal+=maga[i];break;
            case "fear":
                        magf[i]=(jsondata[key]["tones"][z]["score"]);
                        ftotal+=magf[i];break;
            case "joy":
                        magj[i]=(jsondata[key]["tones"][z]["score"]);
                        jtotal+=magj[i];break;
            case "sadness":
                            mags[i]=(jsondata[key]["tones"][z]["score"]);
                            stotal+=mags[i];break;
            case "analytical":
                               magan[i]=(jsondata[key]["tones"][z]["score"]);
                               antotal+=magan[i];break;
            case "confident":
                              magc[i]=(jsondata[key]["tones"][z]["score"]);
                              ctotal+=magc[i];break;
            case "tentative":
                              magt[i]=(jsondata[key]["tones"][z]["score"]);
                              ttotal+=magt[i];break;
          }
          labels.push(i+" - " +jsondata[key]["text"] );
          text.push(jsondata[key]["tones"][0]["text"]);
          for(let x=0; x<jsondata[key]["tones"].length; x++){
              if(jsondata[key]["tones"][x]["tone_id"]=="anger"){
                magaa[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="fear"){
                magff[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="joy"){
                magjj[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="sadness"){
                magss[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="analytical"){
                magann[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="confident"){
                magcc[i]=jsondata[key]["tones"][x]["score"];
              }
              else if(jsondata[key]["tones"][x]["tone_id"]=="tentative"){
                magtt[i]=jsondata[key]["tones"][x]["score"];
              }
          }
          if(magaa[i]==null){
            magaa[i]=0;
          }
          if(magff[i]==null){
            magff[i]=0;
          }
          if(magjj[i]==null){
            magjj[i]=0;
          }
          if(magss[i]==null){
            magss[i]=0;
          }
          if(magann[i]==null){
            magann[i]=0;
          }
          if(magcc[i]==null){
            magcc[i]=0;
          }
          if(magtt[i]==null){
            magtt[i]=0;
          }
        }
      }
      var lastval=0, lastindex=0, noval=0;
      for(let x=0; x<magaa.length; x++){
        noval++;
        if(x==magaa.length-1){
          magaa[x]=lastval;
        }
        if(magaa[x]!=0){
            let slope=(magaa[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magaa[x-noval+y]=slope*y+lastval;
            }
            lastval=magaa[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magff.length; x++){
        noval++;
        if(x==magff.length-1){
          magff[x]=lastval;
        }
        if(magff[x]!=0){
            let slope=(magff[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magff[x-noval+y]=slope*y+lastval;
            }
            lastval=magff[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magjj.length; x++){
        noval++;
        if(x==magjj.length-1){
          magjj[x]=lastval;
        }
        if(magjj[x]!=0){
            let slope=(magjj[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magjj[x-noval+y]=slope*y+lastval;
            }
            lastval=magjj[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magss.length; x++){
        noval++;
        if(x==magss.length-1){
          magss[x]=lastval;
        }
        if(magss[x]!=0){
            let slope=(magss[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magss[x-noval+y]=slope*y+lastval;
            }
            lastval=magss[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magann.length; x++){
        noval++;
        if(x==magann.length-1){
          magann[x]=lastval;
        }
        if(magann[x]!=0){
            let slope=(magann[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magann[x-noval+y]=slope*y+lastval;
            }
            lastval=magann[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magcc.length; x++){
        noval++;
        if(x==magcc.length-1){
          magcc[x]=lastval;
        }
        if(magcc[x]!=0){
            let slope=(magcc[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magcc[x-noval+y]=slope*y+lastval;
            }
            lastval=magcc[x];
            lastindex=x;
            noval=0;
        }
      }
      lastval=0; lastindex=0; noval=0;
      for(let x=0; x<magtt.length; x++){
        noval++;
        if(x==magtt.length-1){
          magtt[x]=lastval;
        }
        if(magtt[x]!=0){
            let slope=(magtt[x]-lastval)/(x-lastindex);

            for(let y=0; y<noval; y++){
              magtt[x-noval+y]=slope*y+lastval;
            }
            lastval=magtt[x];
            lastindex=x;
            noval=0;
        }
      }
      let total=atotal+ftotal+jtotal+stotal+antotal+ctotal+ttotal;
      angerRatio=Math.round(100*atotal/total);
      fearRatio=Math.round(100*ftotal/total);
      joyRatio=Math.round(100*jtotal/total);
      sadnessRatio=Math.round(100*stotal/total);
      analyticalRatio=Math.round(100*antotal/total);
      confidentRatio=Math.round(100*ctotal/total);
      tentativeRatio=Math.round(100*ttotal/total);
      document.getElementById("apercent").innerHTML+="Anger: "+angerRatio+"%";
      document.getElementById("fpercent").innerHTML+="Fear: "+fearRatio+"%";
      document.getElementById("jpercent").innerHTML+="Joy: "+joyRatio+"%</br>";
      document.getElementById("spercent").innerHTML+="Sadness: "+sadnessRatio+"%";
      document.getElementById("anpercent").innerHTML+="Analytical: "+analyticalRatio+"%";
      document.getElementById("cpercent").innerHTML+="Confident: "+confidentRatio+"%";
      document.getElementById("tpercent").innerHTML+="Tentative: "+tentativeRatio+"%";
}

  </script>
    <div id="resultdiv">
      <h1 class="title">Vibes</h1>
      <h2 id="movietitle">&nbsp</h2>
    </div>


    <div class="canvasdiv">
      <h3 id="analyzing"> Analyzing...</h3>
    <canvas id="myChart"></canvas>
    </div>
  <script>
  function renderChart(){
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Anger',
                data: maga,
                backgroundColor: 'rgba(255, 0, 0, .3)',
                borderColor: 'rgba(255, 0, 0, .8)',
                borderWidth: 1
            },
            {
                label: 'Fear',
                data: magf,
                backgroundColor: 'rgba(170, 0, 255, .3)',
                borderColor: 'rgba(170, 0, 255, .8)',
                borderWidth: 1
            },
            {
                label: 'Joy',
                data: magj,
                backgroundColor: 'rgba(255, 235, 0, .3)',
                borderColor: 'rgba(255, 235, 0, 0.8)',
                borderWidth: 1
            },
            {
                label: 'Sadness',
                data: mags,
                backgroundColor: 'rgba(0, 0, 255, .3)',
                borderColor: 'rgba(0, 0, 255, 0.8)',
                borderWidth: 1
            },
            {
                label: 'Analytical',
                data: magan,
                backgroundColor: 'rgba(0, 255, 230, .3)',
                borderColor: 'rgba(0, 255, 230, 0.8)',
                borderWidth: 1
            },
            {
                label: 'Confident',
                data: magc,
                backgroundColor: 'rgba(255, 127, 0, .3)',
                borderColor: 'rgba(255, 127, 0, 0.8)',
                borderWidth: 1
            },
            {
                label: 'Tentative',
                data: magt,
                backgroundColor: 'rgba(0, 230, 64, .3)',
                borderColor: 'rgba(0, 230, 64, .8)',
                borderWidth: 1
            }
          ]
        },
        options: {
            scales: {
              xAxes: [{
                stacked: true,
                ticks: {
                display: false
              }
              }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    stacked: true,
                    ticks: {
                    display: false
                    }
                }]
              }
            }
      });

      var ctx2 = document.getElementById('myChart2').getContext('2d');
      var myChart2 = new Chart(ctx2, {
          type: 'line',
          data: {
              labels: labels,
              datasets: [{
                  label: 'Anger',
                  fill: false,
                  data: magaa,
                  backgroundColor: 'rgba(255, 0, 0, .3)',
                  borderColor: 'rgba(255, 0, 0, .8)',
                  yAxisID: "y-axis-1",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Fear',
                  fill: false,
                  data: magff,
                  backgroundColor: 'rgba(170, 0, 255, .3)',
                  borderColor: 'rgba(170, 0, 255, .8)',
                  yAxisID: "y-axis-2",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Joy',
                  fill: false,
                  data: magjj,
                  backgroundColor: 'rgba(255, 235, 0, .3)',
                  borderColor: 'rgba(255, 235, 0, 0.8)',
                  yAxisID: "y-axis-3",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Sadness',
                  fill: false,
                  data: magss,
                  backgroundColor: 'rgba(0, 0, 255, .3)',
                  borderColor: 'rgba(0, 0, 255, 0.8)',
                  yAxisID: "y-axis-4",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Analytical',
                  fill: false,
                  data: magann,
                  backgroundColor: 'rgba(0, 255, 230, .3)',
                  borderColor: 'rgba(0, 255, 230, 0.8)',
                  yAxisID: "y-axis-5",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Confident',
                  fill: false,
                  data: magcc,
                  backgroundColor: 'rgba(255, 127, 0, .3)',
                  borderColor: 'rgba(255, 127, 0, 0.8)',
                  yAxisID: "y-axis-6",
                  pointRadius: 0,
                  borderWidth: 1
              },

              {
                  label: 'Tentative',
                  fill: false,
                  data: magtt,
                  backgroundColor: 'rgba(0, 230, 64, .3)',
                  borderColor: 'rgba(0, 230, 64, .8)',
                  yAxisID: "y-axis-7",
                  pointRadius: 0,
                  borderWidth: 1
              }

            ]
          },
          options: {
                responsive: true,
                hoverMode: 'index',
                stacked: false,
                title:{
                    display: true,
                    text:''
	      },
	      scaleShowLabels : false,
	      scales: {
	      xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }],
                    yAxes: [{
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "left",
                        id: "y-axis-1",
                        ticks: {
                          display: false
                        }
                    }, {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-2",
                        ticks: {
                          display: false
                        }
                        },
                        {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-3",
                        ticks: {
                          display: false
                        }
                        },
                        {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-4",
                        ticks: {
                          display: false
                        }
                        },
                        {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-5",
                        ticks: {
                          display: false
                        }
                        },
                        {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-6",
                        ticks: {
                          display: false
                        }
                        },
                        {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-7",
                        ticks: {
                          display: false
                        }
                        }
                    ],
                }
              }
        });

}
  </script>

<div id="percent">
  <div id="apercent" class="diffpercent"></div>
  <div id="fpercent" class="diffpercent"></div>
  <div id="jpercent" class="diffpercent"></div>
  <div id="spercent" class="diffpercent"></div>
  <div id="anpercent" class="diffpercent"></div>
  <div id="cpercent" class="diffpercent"></div>
  <div id="tpercent" class="diffpercent"></div>
</div>
<div class="canvasdiv">
  <canvas id="myChart2"></canvas>
</div>
<div id="buttondiv">
  <a class="buttonclass" href="index.php">Back to Search</a>
</div>

</body>
</html>
