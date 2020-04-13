<!DOCTYPE html>
<html lang="en">
 <head> 
  <meta charset="utf-8" /> 
  <title>404 error page </title> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
	<!--Favicon img-->
	<link rel="icon" type="image/png" href="public/img/logo.png" />
  <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> 
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" /> 
  <link href="public/css/style.css" type="text/css" rel="stylesheet" media="all" /> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
    <script src="https://cdn.bootcss.com/particles.js/2.0.0/particles.min.js"></script> 
 </head> 
 <body> 
  <div id="particles-js"> 
   <div class="page-404"> 
    <div class="outer"> 
     <div class="middle"> 
      <div class="inner"> 
       <!--BEGIN CONTENT--> 
       <div class="inner-circle">
        <i class="fa fa-home"></i>
        <span>404</span>
       </div> 
       <span class="inner-status">Oops! You're lost</span> 
       <span class="inner-detail" style="color:#fff;"> Nous ne parvenons pas a trouver la page demandée. <a href="index.php" class="btn btn-info mtl"><i class="fa fa-home"></i>&nbsp; Retour accueil</a> </span> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <script type="text/javascript">
	
particlesJS("particles-js", {
    "particles": {
		"number": {
			"value": 80,
			"density": {
				"enable": true,
				"value_area": 800
			}
		},
		"color": {
			"value": "#ffffff"
		},
		"shape": {
			"type": "circle",
			"stroke": {
				"width": 0,
				"color": "#000000"
			},
			"polygon": {
				"nb_sides": 5
			},
			"image": {
				"src": "img/github.svg",
				"width": 100,
				"height": 100
			}
		},
		"opacity": {
			"value": 0.5,
			"random": false,
			"anim": {
				"enable": false,
				"speed": 1,
				"opacity_min": 0.1,
				"sync": false
			}
		},
		"size": {
			"value": 3,
			"random": true,
			"anim": {
				"enable": false,
				"speed": 40,
				"size_min": 0.1,
				"sync": false
			}
		},
		"line_linked": {
			"enable": true,
			"distance": 150,
			"color": "#ffffff",
			"opacity": 0.4,
			"width": 1
		},
		"move": {
			"enable": true,
			"speed": 6,
			"direction": "none",
			"random": false,
			"straight": false,
			"out_mode": "out",
			"bounce": false,
			"attract": {
				"enable": false,
				"rotateX": 600,
				"rotateY": 1200
			}
		}
	},
	"interactivity": {
		"detect_on": "canvas",
		"events": {
			"onhover": {
				"enable": true,
				"mode": "grab"
			},
			"onclick": {
				"enable": true,
				"mode": "push"
			},
			"resize": true
		},
		"modes": {
			"grab": {
				"distance": 140,
				"line_linked": {
					"opacity": 1
				}
			},
			"bubble": {
				"distance": 400,
				"size": 40,
				"duration": 2,
				"opacity": 8,
				"speed": 3
			},
			"repulse": {
				"distance": 200,
				"duration": 0.4
			},
			"push": {
				"particles_nb": 4
			},
			"remove": {
				"particles_nb": 2
			}
		}
	},
	"retina_detect": true
});
</script>  
 </body>
</html>