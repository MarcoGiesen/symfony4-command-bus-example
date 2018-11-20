Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/xenial64"

    config.vm.hostname = "symfony4-vagrant"
    config.vm.network 'private_network', ip: '192.168.13.42'

    config.vm.provider :virtualbox do |vb|
        vb.customize ["modifyvm", :id, "--memory", "2048"]
        vb.customize ["modifyvm", :id, "--cpus", "1"]

        vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    end

    config.ssh.forward_agent = true

    config.vm.synced_folder '.', '/var/www/project', id: 'vagrant-share', :nfs => true, :chown_ignore => true, :chmod_ignore => true, :mount_options => ['rw', 'vers=3', 'tcp', 'fsc', 'actimeo=2']
    config.vm.synced_folder '.', '/vagrant', disabled: true

    config.vm.provision "shell", path: "dist/scripts/vagrant.sh"

    config.hostsupdater.aliases = [
        "dev.symfony4-command-bus.com"
    ]
end

