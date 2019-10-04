<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />

	<meta name="description" content="Open Health Imaging Foundation DICOM Viewer" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="theme-color" content="#000000" />
	<meta http-equiv="cleartype" content="on" />
	<meta name="MobileOptimized" content="320" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="apple-mobile-web-app-capable" content="yes" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	 crossorigin="anonymous" />

	<!-- WEB FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Sanchez" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
	 crossorigin="anonymous" />

	<title>OHIF Standalone Viewer</title>
</head>

  <body>
    <noscript> You need to enable JavaScript to run this app. </noscript>

    <div id="root"></div>
    <script crossorigin src="https://unpkg.com/@ohif/viewer@1.4.3/dist/index.umd.js"></script>
    <script crossorigin src="https://unpkg.com/@ohif/extension-dicom-microscopy@0.50.5/dist/index.umd.js"></script>
    <script crossorigin src="https://unpkg.com/@ohif/extension-vtk@0.52.1/dist/index.umd.js"></script>
    <script crossorigin src="https://unpkg.com/@ohif/extension-cornerstone@1.2.5/dist/index.umd.js"></script>
    <script crossorigin src="https://unpkg.com/@ohif/extension-dicom-html@1.0.0/dist/index.umd.js"></script>
    
    <script>
      var containerId = "root";
      var componentRenderedOrUpdatedCallback = function() {
          console.log("OHIF Viewer rendered/updated");
        };
      window.OHIFViewer.installViewer(
        {
          routerBasename: '/ohif',
          showStudyList: false,
          servers: {
            dicomWeb: [
              {
                name: "Orthanc",
                wadoUriRoot:
                  "/orthanc/wado",
                qidoRoot:
                  "/orthanc/dicom-web",
                wadoRoot:
                  "/orthanc/dicom-web",
                qidoSupportsIncludeField: true,
                imageRendering: "wadors",
                thumbnailRendering: "wadors"
              }
            ]
          },
          extensions: [OHIFExtDicomMicroscopy, OHIFExtVtk, OHIFExtCornerstone, OHIFExtDicomHtml]
        },
        containerId,
        componentRenderedOrUpdatedCallback
      );

    </script>

  </body>

</html>
