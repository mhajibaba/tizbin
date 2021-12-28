<?php
include_once __DIR__ . '/core/db/tb_inputs.php';
$cloudstat = TableInputFiles::list($sid);
?>

  <div class="card" data-aos="flip-left" data-aos-delay="150">
    <div class="card-body">
      <h6 class="card-title text-center"><strong>Input Files</strong></h6>
      <div id="filecloud" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_files.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Packet CAPture (PCAP) files contain copies of all captured packets for a given timespan.
      These files are mainly used in analyzing the network characteristics of a certain data. </small></p>
    </div>
  </div>

  <script src="js/d3.v3.min.js"></script>
  <script src="js/d3.layout.cloud.js"></script>
  <script>

  // Encapsulate the word cloud functionality
  function wordCloud(selector) {

      var fill = d3.scale.category20();

      //Construct the word cloud's SVG element
      var svg = d3.select(selector).append("svg")
          .attr("width", 250)
          .attr("height", 200)
          .append("g")
          .attr("transform", "translate(120,100)");


      //Draw the word cloud
      function draw(words) {
          var cloud = svg.selectAll("g text")
                          .data(words, function(d) { return d.text; })

          //Entering words
          cloud.enter()
              .append("text")
              .style("font-family", "Impact")
              .style("fill", function(d, i) { return fill(i); })
              .attr("text-anchor", "middle")
              .attr('font-size', 1)
              .text(function(d) { return d.text; });

          //Entering and existing words
          cloud
              .transition()
                  .duration(600)
                  .style("font-size", function(d) { return d.size + "px"; })
                  .attr("transform", function(d) {
                      return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                  })
                  .style("fill-opacity", 1);

          //Exiting words
          cloud.exit()
              .transition()
                  .duration(200)
                  .style('fill-opacity', 1e-6)
                  .attr('font-size', 1)
                  .remove();
      }


      //Use the module pattern to encapsulate the visualisation code. We'll
      // expose only the parts that need to be public.
      return {

          //Recompute the word cloud for a new set of words. This method will
          // asycnhronously call draw when the layout has been computed.
          //The outside world will need to call this function, so make it part
          // of the wordCloud return value.
          update: function(words) {
              d3.layout.cloud().size([250, 250])
                  .words(words)
                  .padding(5)
                  .rotate(function() { return ~~(Math.random() * 2) * 90; })
                  .font("Impact")
                  .fontSize(function(d) { return d.size; })
                  .on("end", draw)
                  .start();
          }
      }

  }

  <?php
  echo "var javascript_array_cloud = ". json_encode($cloudstat) . ";\n";
  ?>
  var words = [];
  var totalsize = 0;
  var i = 1;

  i = 0;
  var innerArray = [];
  for (var key in javascript_array_cloud) {
    innerArray.push({ text: javascript_array_cloud[key]['filename'],
                      size: 10 + Math.random() * 20 });
    i++;
    if(i%7 == 0) {
      words.push(innerArray);
      innerArray = [];
    }
  }

  if(i%7 != 0) {
    words.push(innerArray);
    innerArray = [];
  }

  // List of words
  var words2 = [{text: "Running", size: "8"}, {text: "Surfing", size: "25"} ]

  //Prepare one of the sample sentences by removing punctuation,
  // creating an array of words and computing a random size attribute.
  function getWords(i) {
    return words[i]
  }

  //This method tells the word cloud to redraw with a new set of words.
  //In reality the new words would probably come from a server request,
  // user input or some other source.
  function showNewWords(vis, i) {
      i = i || 0;

      vis.update(getWords(i ++ % words.length))
      setTimeout(function() { showNewWords(vis, i + 1)}, 2000)
  }

  //Create a new instance of the word cloud visualisation.
  var myWordCloud = wordCloud('div#filecloud');

  //Start cycling through the demo data
  showNewWords(myWordCloud);


  </script>
