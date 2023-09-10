<html>
  <head>
    <title>Places Search Box</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="../CSS/map.css" />
    <script type="module" src="./../Admin/index.js"></script>
  </head>
  <body>
    <input
      id="pac-input"
      class="controls"
      type="text"
      placeholder="Search Box"
    />
    <div id="map"></div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises
      with https://www.npmjs.com/package/@googlemaps/js-api-loader.
     
      -->
       <script
    
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzDDsptowMgDCnrOm1zbiZV4TgLbzKakA&callback=initAutocomplete&libraries=places&v=weekly"
      defer 
    ></script> 
  </body>
</html>