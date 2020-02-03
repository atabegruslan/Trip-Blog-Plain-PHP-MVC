module.exports = function(grunt)
{
	grunt.initConfig({
		pkg:grunt.file.readJSON('package.json'),
		coffee:{
			compile:{
				files:{
					'public/js/site.js' : 'views/coffee/site.coffee'
				}
			}
		},
		less:{
			compile:{
				files:{
					'public/css/site.css' : 'views/less/site.less'
				}
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-coffee');
	grunt.registerTask('default', ['coffee', 'less']);
}
