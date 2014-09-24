module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {
			dist: {
				options: {
					sassDir: 'sass',
					cssDir: 'css',
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
                        'bower/bootstrap/dist/js/bootstrap.min.js'
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
