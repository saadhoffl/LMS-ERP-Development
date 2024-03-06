const { obfuscate } = require("javascript-obfuscator");

module.exports = function(grunt){

    grunt.initConfig({
        cssmin: {
          options: {
            mergeIntoShorthands: false,
            roundingPrecision: -1,
            sourceMap: true,
          },
          target: {
            files: {
              '../../htdocs/css/style.css': ['../css/**/*.css'],
              '../../htdocs/scss/stylescss.css': ['../scss/**/*.scss']
            }
          }
        },

        copy: {
          jquery: {
            files: [
              {
                expand: true, 
                flatten: true,
                filter: 'isFile',
                src: ['bower_components/jquery/dist/*'], 
                dest: '../../htdocs/js/jquery'},
            ],
          },
        },

        obfuscator: {
          options: {
              banner: '// obfuscated with grunt-contrib-obfuscator.\n',
              debugProtection: false,
              debugProtectionInterval: false,
              // domainLock: ['www.example.com']
          },
          task1: {
              options: {
                  // options for each sub task
              },
              files: {
                  '../../htdocs/js/app.js': [
                      '../js/**/*.js'
                  ]
              }
          }
      },

        watch: {
          cssmin: {
            files: ['../css/**/*.css', '../scss/**/*.scss'], 
            tasks: ['cssmin'],
            options: {
              spawn: false,
            },
          },

          obfuscator: {
            files: ['../js/**/*.js'],
            tasks: ['obfuscator'],
            options: {
              spawn: false,
            },
          },

        },

      });
    
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-obfuscator');   
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.registerTask('default',['cssmin','copy','obfuscator','watch']);
};