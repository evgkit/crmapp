Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/trusty64"

  #config.vm.provision :shell, :path => "bootstrap/01-prepare-trusty64.sh"
  config.vm.provision :shell, :path => "bootstrap/02-configure-app-for-trusty64.sh"
  config.vm.provision :shell, :path => "bootstrap/03-configure-app.sh"

  config.vm.network "forwarded_port", guest: 80, host: 8888

end