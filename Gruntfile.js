"use strict";

module.exports = function (grunt) {

  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    watch: {
      options: {
        livereload: true
      },
      html: {
        files: "**/*.php"
      },
      sass: {
        files: "dev/scss/**/*.scss",
        tasks: ["sass", "cmq", "postcss", "cssmin"]
      },
      js: {
        files: ["dev/js/**/*.js", "Gruntfile.js"],
        tasks: ["uglify"]
      },
      images: {
        files: "dev/img/**/*.{png,jpg,gif}",
        tasks: ["imagemin"]
      },
      svg: {
        files: "dev/svg/**/*.svg",
        tasks: ["svgmin"]
      }
    },

    sass: {
      options: {
        sourceMap: true
      },
      dist: {
        files: {
          'style.css': 'dev/scss/style.scss'
        }
      }
    },

    postcss: {
      options: {
        processors: [
          require('autoprefixer-core')({ browsers: 'last 3 versions' })
        ]
      },
      dist: {
        src: 'style.css'
      }
    },

    cmq: {
      options: {
        log: true
      },
      dist: {
        files: {
          'style.css': 'style.css'
        }
      }
    },

    cssmin: {
      options: {
        keepSpecialComments: 1,
        noAdvanced: true
      },
      css: {
        files: {
          "style.css": "style.css"
        }
      }
    },

    uglify: {
      options: {
        mangle: true
      },
      production: {
        files: {
          "js/scripts.js": "dev/js/scripts.js",
          "js/slick.js": "dev/js/slick.js"
        }
      }
    },

    imagemin: {
      dynamic: {
        options: {
          optimizationLevel: 7,
          progressive: true
        },
        files: [{
          expand: true,
          cwd: 'dev/img/',
          src: '**/*.{png,jpg,gif}',
          dest: 'img/'
        }]
      }
    },

    svgmin: {
      options: {
        plugins: [{
          removeViewBox: false
        }, {
          removeUselessStrokeAndFill: false
        }, {
          removeEmptyAttrs: false
        }]
      },
      dist: {
        expand: true,
        cwd: 'dev/svg/',
        src: '*.svg',
        dest: 'includes/svg'
      }
    },

    browserSync: {
      dev: {
        bsFiles: {
          src: [
            'style.css',
            'js/*.js',
            '**/*.php',
          ]
        },
        options: {
          watchTask: true,
          proxy: "blog.animale.local"
        }
      }
    },

    ftpush: {
      build: {
        auth: {
          host: "",
          port: 21,
          authKey: "key1"
        },
        src: ".",
        dest: "/www/wp-content/themes/animale/",
        exclusions: [
          ".DS_Store",
          "Thumbs.db",
          "LICENSE",
          "README.md",
          "Gruntfile.js",
          "package.json",
          "node_modules",
          ".ftppass",
          ".gitignore",
          ".git",
          ".sass-cache",
          ".sublime-grunt.cache",
          "dev"
        ]
      }
    },

    devUpdate: {
      main: {
        options: {
          updateType: 'force',
          reportUpdated: false,
          semver: false,
          packages: {
            devDependencies: true,
            dependencies: false
          },
          packageJson: null,
          reportOnlyPkgs: []
        }
      }
    }

  });

  grunt.registerTask("default", ["browserSync", "watch"]);
  grunt.registerTask("css", ["sass", "cmq", "postcss", "cssmin"]);
  grunt.registerTask("js", ["uglify"]);
  grunt.registerTask("img", ["imagemin"]);
  grunt.registerTask("svg", ["svgmin"]);
  grunt.registerTask("compile", ["sass", "cmq", "postcss", "cssmin", "uglify", "imagemin", "svgmin"]);
  grunt.registerTask("update", ["devUpdate"]);
  grunt.registerTask("deploy", ["sass", "cmq", "postcss", "cssmin", "uglify", "imagemin", "svgmin", "ftpush"]);

};
