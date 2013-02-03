# Require any additional compass plugins here.

# Set this to the root of your project when deployed:
http_path = "/"
http_css_path = "/css"
http_javascripts_path = "/js"
http_images_path = "/img"
css_dir = "web/css"
sass_dir = "sass"
images_dir = "web/img"
javascripts_dir = "web/js"

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
output_style = :compact

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false
line_comments = false

# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass

relative_assets = false

# Increment the deploy_version before every release to force cache busting.
deploy_version = 1
asset_cache_buster do |http_path, real_path|
  if File.exists?(real_path)
    Digest::MD5.hexdigest(real_path.read)[0..7]
  else
    "v=#{deploy_version}"
  end
end

on_stylesheet_saved do |filename|
  `php cli/create_static_files.php`
end
