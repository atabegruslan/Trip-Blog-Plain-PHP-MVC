/* Simple transpiling - Run `grunt` */

// module.exports = function(grunt)
// {
// 	grunt.initConfig({
// 		pkg:grunt.file.readJSON('package.json'),
// 		coffee:{
// 			compile:{
// 				files:{
// 					'prebuilt/js/add.js' : 'prebuilt/coffee/add.coffee',
// 					'prebuilt/js/times.js' : 'prebuilt/coffee/times.coffee'
// 				}
// 			}
// 		},
// 		less:{
// 			compile:{
// 				files:{
// 					'prebuilt/css/red.css' : 'prebuilt/less/red.less',
// 					'prebuilt/css/blue.css' : 'prebuilt/less/blue.less'
// 				}
// 			}
// 		}
// 	});

// 	grunt.loadNpmTasks('grunt-contrib-less');
// 	grunt.loadNpmTasks('grunt-contrib-coffee');
// 	grunt.registerTask('default', ['coffee', 'less']);
// }

/* Watch - Run `grunt watch` */
/* You should see "Waiting...". Press Cntr+C to exit. */

// module.exports = function(grunt)
// {
// 	grunt.initConfig({
// 		pkg:grunt.file.readJSON('package.json'),
// 		coffee:{
// 			compile:{
// 				files:{
// 					'prebuilt/js/add.js' : 'prebuilt/coffee/add.coffee',
// 					'prebuilt/js/times.js' : 'prebuilt/coffee/times.coffee'
// 				}
// 			}
// 		},
// 		less:{
// 			compile:{
// 				files:{
// 					'prebuilt/css/red.css' : 'prebuilt/less/red.less',
// 					'prebuilt/css/blue.css' : 'prebuilt/less/blue.less'
// 				}
// 			}
// 		},
// 		watch:{
// 			files:['prebuilt/coffee/*.coffee', 'prebuilt/less/*.less'],
// 			tasks:['coffee', 'less'],
// 		}
// 	});

// 	grunt.loadNpmTasks('grunt-contrib-less');
// 	grunt.loadNpmTasks('grunt-contrib-coffee');
// 	grunt.loadNpmTasks('grunt-contrib-watch');
// 	grunt.registerTask('default', ['coffee', 'less']);
// }

/* Live reload - Run `grunt server` */
/* You should see "Waiting...". Press Cntr+C to exit. */

// module.exports = function(grunt)
// {
// 	grunt.initConfig({
// 		pkg:grunt.file.readJSON('package.json'),
//		coffee:{
//			compile:{
//				files:{
//					'prebuilt/js/add.js' : 'prebuilt/coffee/add.coffee',
//					'prebuilt/js/times.js' : 'prebuilt/coffee/times.coffee'
//				}
//			}
//		},
//		less:{
//			compile:{
//				files:{
//					'prebuilt/css/red.css' : 'prebuilt/less/red.less',
//					'prebuilt/css/blue.css' : 'prebuilt/less/blue.less'
//				}
//			}
//		},
//		watch:{
//			options:{livereload:true},
//			coffee:{
//				files:'prebuilt/coffee/*.coffee',
//				tasks:'coffee'
//			},
//			less:{
//				files:'prebuilt/less/*.less',
//				tasks:'less'
//			}
//		},
// 		express:{
// 			all:{
// 				options:{
// 					port:9000,
// 					hostname:'localhost',
// 					bases:['.'],
// 					livereload:true
// 				}
// 			}
// 		}
// 	});

// 	grunt.loadNpmTasks('grunt-contrib-less');
// 	grunt.loadNpmTasks('grunt-contrib-coffee');
// 	grunt.loadNpmTasks('grunt-contrib-watch');
// 	grunt.loadNpmTasks('grunt-express');
// 	grunt.registerTask('default', ['coffee', 'less']);
// 	grunt.registerTask('server', ['express', 'watch']);
// }

/* load-grunt-tasks and usemin plugins - Run `grunt build` */

module.exports = function(grunt)
{
	require('load-grunt-tasks')(grunt)
	grunt.initConfig({
		useminPrepare:{
			html:'prebuilt/header.html',
			options:{dest:'views'}
		},
		usemin:{
			html:['views/header.html']
		},
		copy:{
			task0:{
				src:'prebuilt/header.html',
				dest:'views/header.html'
			}
		}
	});

	// No need to verbose these anymore
	//grunt.loadNpmTasks('grunt-contrib-copy');
	//grunt.loadNpmTasks('grunt-contrib-concat');
	//grunt.loadNpmTasks('grunt-contrib-cssmin');
	//grunt.loadNpmTasks('grunt-contrib-uglify');
	//grunt.loadNpmTasks('grunt-usemin');

	grunt.registerTask(
		'build', 
		[
			'copy:task0', 
			'useminPrepare',
			'concat',
			'cssmin',
			'uglify',
			'usemin'
		]
	);
}
