module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        cssmin: {
            with_banner: {
                options: {
                    banner: '/* \n' +
                        'Minified CSS of <%= pkg.name %> \n' +
                        '*/'
                },
                files: {
                    'css/all.css': [
                        'src/css/common.css',
                        'src/css/carousel.css',
                        'src/css/column-gs.css',
                        'src/css/form.css',
                        'src/css/header.css',
                        'src/css/project.css',
                        'src/css/main.css'
                    ]
                }
            }
        },
        watch: {
            css: {
                files: 'src/css/*.css',
                tasks: ['cssmin'],
                options: {
                    livereload: true,
                }
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['cssmin']);
};
