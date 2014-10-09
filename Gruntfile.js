module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {
			dist: {
				options: {
					sassDir: 'sass',
					cssDir: 'stylesheets',
                    environment: 'production'
				}
			}
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: ['compass']
			},
            js: {
                files: 'javascripts/**/*.js',
                tasks: 'uglify'
            }
		},
        uglify: {
            all: {
                files: {
                    'javascripts/walton-street.min.js': [
                        'bower/jquery/dist/jquery.min.js',
                        'bower/bootstrap/dist/js/bootstrap.min.js',
                        'js/jquery.fancybox.pack.js',
                        'js/jquery.form.js',
                        'js/walton-street.js'
                    ]
                }
            }
        }
	});
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.registerTask('default',['compass:dist', 'uglify', 'watch' ]);
}
