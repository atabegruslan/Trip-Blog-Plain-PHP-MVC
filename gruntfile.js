/* Simple transpiling - Run `grunt` */

// module.exports = function(grunt)
// {
// 	grunt.initConfig({
// 		pkg:grunt.file.readJSON('package.json'),
// 		coffee:{
// 			compile:{
// 				files:{
// 					'public/js/site.js' : 'views/coffee/site.coffee'
// 				}
// 			}
// 		},
// 		less:{
// 			compile:{
// 				files:{
// 					'public/css/site.css' : 'views/less/site.less'
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
// 					'public/js/site.js' : 'views/coffee/site.coffee'
// 				}
// 			}
// 		},
// 		less:{
// 			compile:{
// 				files:{
// 					'public/css/site.css' : 'views/less/site.less'
// 				}
// 			}
// 		},
// 		watch:{
// 			files:['views/coffee/*.coffee', 'views/less/*.less'],
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
// 		coffee:{
// 			compile:{
// 				files:{
// 					'public/js/site.js' : 'views/coffee/site.coffee'
// 				}
// 			}
// 		},
// 		less:{
// 			compile:{
// 				files:{
// 					'public/css/site.css' : 'views/less/site.less'
// 				}
// 			}
// 		},
// 		watch:{
// 			options:{livereload:true},
// 			coffee:{
// 				files:'views/coffee/*.coffee',
// 				tasks:'coffee'
// 			},
// 			less:{
// 				files:'views/less/*.less',
// 				tasks:'less'
// 			}
// 		},
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

/* load-grunt-tasks plugin - Run `grunt build` */
/* @todo unfinished */

module.exports = function(grunt)
{
	require('load-grunt-tasks')(grunt)
	grunt.initConfig({
		useminPrepare:{
			html:'start/index.html',
			options:{dest:'finish'}
		},
		usemin:{
			html:['finish/index.html']
		},
		copy:{
			task0:{
				src:'start/index.html',
				dest:'finish/index.html'
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
