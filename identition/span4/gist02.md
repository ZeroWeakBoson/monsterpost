## Binary

Once the System Properties window opens, click on the “Environment Variables” button. In the “System Variables” box, look for a variable called Path. see all executables in your PATH on your system, and all aliases, all sorted

```
$ find ${PATH//:/ } -maxdepth 1 -executable | sort

/bin
/bin/bash
/bin/bunzip2
/bin/bzcat
/bin/bzcmp
/bin/bzdiff
/bin/bzegrep
/bin/bzexe
/bin/bzfgrep
/bin/bzgrep
/bin/bzip2
/bin/bzip2recover
/bin/bzless
/bin/bzmore
/bin/cat
/bin/chgrp
/bin/chmod
/bin/chown
/bin/cp
/bin/dash
/bin/date
/bin/dd
/bin/df
/bin/dir
/bin/dmesg
/bin/dnsdomainname
/bin/domainname
/bin/echo
/bin/egrep
/bin/false
/bin/fgrep
/bin/findmnt
/bin/fuser
/bin/grep
/bin/gunzip
/bin/gzexe
/bin/gzip
/bin/hostname
/bin/journalctl
/bin/kill
/bin/less
/bin/lessecho
/bin/lessfile
/bin/lesskey
/bin/lesspipe
/bin/ln
/bin/login
/bin/loginctl
/bin/ls
/bin/lsblk
/bin/mkdir
/bin/mknod
/bin/mktemp
/bin/more
/bin/mount
/bin/mountpoint
/bin/mv
/bin/networkctl
/bin/nisdomainname
/bin/pidof
/bin/ping
/bin/ping4
/bin/ping6
/bin/ps
/bin/pwd
/bin/rbash
/bin/readlink
/bin/rm
/bin/rmdir
/bin/run-parts
/bin/sed
/bin/sh
/bin/sleep
/bin/stty
/bin/su
/bin/sync
/bin/systemctl
/bin/systemd
/bin/systemd-ask-password
/bin/systemd-escape
/bin/systemd-inhibit
/bin/systemd-machine-id-setup
/bin/systemd-notify
/bin/systemd-sysusers
/bin/systemd-tmpfiles
/bin/systemd-tty-ask-password-agent
/bin/tar
/bin/tempfile
/bin/touch
/bin/true
/bin/umount
/bin/uname
/bin/uncompress
/bin/vdir
/bin/wdctl
/bin/which
/bin/ypdomainname
/bin/zcat
/bin/zcmp
/bin/zdiff
/bin/zegrep
/bin/zfgrep
/bin/zforce
/bin/zgrep
/bin/zless
/bin/zmore
/bin/znew
/sbin
/sbin/agetty
/sbin/apparmor_parser
/sbin/badblocks
/sbin/blkdeactivate
/sbin/blkdiscard
/sbin/blkid
/sbin/blkzone
/sbin/blockdev
/sbin/capsh
/sbin/cfdisk
/sbin/chcpu
/sbin/ctrlaltdel
/sbin/debugfs
/sbin/dmsetup
/sbin/dmstats
/sbin/dumpe2fs
/sbin/e2fsck
/sbin/e2image
/sbin/e2label
/sbin/e2mmpstatus
/sbin/e2undo
/sbin/fdisk
/sbin/findfs
/sbin/fsck
/sbin/fsck.cramfs
/sbin/fsck.ext2
/sbin/fsck.ext3
/sbin/fsck.ext4
/sbin/fsck.minix
/sbin/fsfreeze
/sbin/fstab-decode
/sbin/fstrim
/sbin/getcap
/sbin/getpcaps
/sbin/getty
/sbin/halt
/sbin/hwclock
/sbin/init
/sbin/installkernel
/sbin/ip6tables
/sbin/ip6tables-restore
/sbin/ip6tables-save
/sbin/iptables
/sbin/iptables-restore
/sbin/iptables-save
/sbin/isosize
/sbin/killall5
/sbin/ldconfig
/sbin/logsave
/sbin/losetup
/sbin/mke2fs
/sbin/mkfs
/sbin/mkfs.bfs
/sbin/mkfs.cramfs
/sbin/mkfs.ext2
/sbin/mkfs.ext3
/sbin/mkfs.ext4
/sbin/mkfs.minix
/sbin/mkhomedir_helper
/sbin/mkswap
/sbin/pam_tally
/sbin/pam_tally2
/sbin/pivot_root
/sbin/poweroff
/sbin/raw
/sbin/reboot
/sbin/resize2fs
/sbin/runlevel
/sbin/runuser
/sbin/setcap
/sbin/sfdisk
/sbin/shadowconfig
/sbin/shutdown
/sbin/start-stop-daemon
/sbin/sulogin
/sbin/swaplabel
/sbin/swapoff
/sbin/swapon
/sbin/switch_root
/sbin/sysctl
/sbin/telinit
/sbin/tune2fs
/sbin/unix_chkpwd
/sbin/unix_update
/sbin/wipefs
/sbin/zramctl
/usr/bin
/usr/bin/2to3-2.7
/usr/bin/[
/usr/bin/aa-enabled
/usr/bin/aa-exec
/usr/bin/add-apt-repository
/usr/bin/addpart
/usr/bin/addr2line
/usr/bin/apt
/usr/bin/apt-add-repository
/usr/bin/apt-cache
/usr/bin/apt-cdrom
/usr/bin/apt-config
/usr/bin/apt-get
/usr/bin/apt-key
/usr/bin/apt-mark
/usr/bin/ar
/usr/bin/arch
/usr/bin/as
/usr/bin/awk
/usr/bin/b2sum
/usr/bin/base32
/usr/bin/base64
/usr/bin/basename
/usr/bin/bashbug
/usr/bin/bootctl
/usr/bin/busctl
/usr/bin/c++
/usr/bin/c++filt
/usr/bin/c89
/usr/bin/c89-gcc
/usr/bin/c99
/usr/bin/c99-gcc
/usr/bin/c_rehash
/usr/bin/captoinfo
/usr/bin/catchsegv
/usr/bin/cc
/usr/bin/chage
/usr/bin/chattr
/usr/bin/chcon
/usr/bin/chfn
/usr/bin/choom
/usr/bin/chrt
/usr/bin/chsh
/usr/bin/cksum
/usr/bin/clear
/usr/bin/clear_console
/usr/bin/cmp
/usr/bin/comm
/usr/bin/compose
/usr/bin/containerd
/usr/bin/containerd-shim
/usr/bin/containerd-shim-runc-v1
/usr/bin/containerd-shim-runc-v2
/usr/bin/corelist
/usr/bin/cpan
/usr/bin/cpan5.28-x86_64-linux-gnu
/usr/bin/cpp
/usr/bin/cpp-8
/usr/bin/csplit
/usr/bin/ctr
/usr/bin/curl
/usr/bin/curl-config
/usr/bin/cut
/usr/bin/cvtsudoers
/usr/bin/dbus-cleanup-sockets
/usr/bin/dbus-daemon
/usr/bin/dbus-monitor
/usr/bin/dbus-run-session
/usr/bin/dbus-send
/usr/bin/dbus-update-activation-environment
/usr/bin/dbus-uuidgen
/usr/bin/deb-systemd-helper
/usr/bin/deb-systemd-invoke
/usr/bin/debconf
/usr/bin/debconf-apt-progress
/usr/bin/debconf-communicate
/usr/bin/debconf-copydb
/usr/bin/debconf-escape
/usr/bin/debconf-set-selections
/usr/bin/debconf-show
/usr/bin/delpart
/usr/bin/dh_python2
/usr/bin/diff
/usr/bin/diff3
/usr/bin/dircolors
/usr/bin/dirmngr
/usr/bin/dirmngr-client
/usr/bin/dirname
/usr/bin/docker
/usr/bin/docker-init
/usr/bin/docker-proxy
/usr/bin/dockerd
/usr/bin/dockerd-rootless-setuptool.sh
/usr/bin/dockerd-rootless.sh
/usr/bin/dpkg
/usr/bin/dpkg-architecture
/usr/bin/dpkg-buildflags
/usr/bin/dpkg-buildpackage
/usr/bin/dpkg-checkbuilddeps
/usr/bin/dpkg-deb
/usr/bin/dpkg-distaddfile
/usr/bin/dpkg-divert
/usr/bin/dpkg-genbuildinfo
/usr/bin/dpkg-genchanges
/usr/bin/dpkg-gencontrol
/usr/bin/dpkg-gensymbols
/usr/bin/dpkg-maintscript-helper
/usr/bin/dpkg-mergechangelogs
/usr/bin/dpkg-name
/usr/bin/dpkg-parsechangelog
/usr/bin/dpkg-query
/usr/bin/dpkg-scanpackages
/usr/bin/dpkg-scansources
/usr/bin/dpkg-shlibdeps
/usr/bin/dpkg-source
/usr/bin/dpkg-split
/usr/bin/dpkg-statoverride
/usr/bin/dpkg-trigger
/usr/bin/dpkg-vendor
/usr/bin/du
/usr/bin/dwp
/usr/bin/echo_supervisord_conf
/usr/bin/edit
/usr/bin/elfedit
/usr/bin/enc2xs
/usr/bin/encguess
/usr/bin/env
/usr/bin/envsubst
/usr/bin/expand
/usr/bin/expiry
/usr/bin/expr
/usr/bin/factor
/usr/bin/faillog
/usr/bin/faked-sysv
/usr/bin/faked-tcp
/usr/bin/fakeroot
/usr/bin/fakeroot-sysv
/usr/bin/fakeroot-tcp
/usr/bin/fallocate
/usr/bin/file
/usr/bin/fincore
/usr/bin/find
/usr/bin/flock
/usr/bin/fmt
/usr/bin/fold
/usr/bin/free
/usr/bin/funzip
/usr/bin/g++
/usr/bin/g++-8
/usr/bin/gapplication
/usr/bin/gcc
/usr/bin/gcc-8
/usr/bin/gcc-ar
/usr/bin/gcc-ar-8
/usr/bin/gcc-nm
/usr/bin/gcc-nm-8
/usr/bin/gcc-ranlib
/usr/bin/gcc-ranlib-8
/usr/bin/gcov
/usr/bin/gcov-8
/usr/bin/gcov-dump
/usr/bin/gcov-dump-8
/usr/bin/gcov-tool
/usr/bin/gcov-tool-8
/usr/bin/gdbus
/usr/bin/gencat
/usr/bin/getconf
/usr/bin/getent
/usr/bin/getopt
/usr/bin/gettext
/usr/bin/gettext.sh
/usr/bin/gettextize
/usr/bin/gio
/usr/bin/gio-querymodules
/usr/bin/git
/usr/bin/git-cvsserver
/usr/bin/git-receive-pack
/usr/bin/git-shell
/usr/bin/git-upload-archive
/usr/bin/git-upload-pack
/usr/bin/gitk
/usr/bin/glib-compile-schemas
/usr/bin/gold
/usr/bin/gpasswd
/usr/bin/gpg
/usr/bin/gpg-agent
/usr/bin/gpg-connect-agent
/usr/bin/gpg-wks-server
/usr/bin/gpg-zip
/usr/bin/gpgcompose
/usr/bin/gpgconf
/usr/bin/gpgparsemail
/usr/bin/gpgsm
/usr/bin/gpgsplit
/usr/bin/gpgtar
/usr/bin/gpgv
/usr/bin/gprof
/usr/bin/gresource
/usr/bin/groups
/usr/bin/gsettings
/usr/bin/h2ph
/usr/bin/h2xs
/usr/bin/head
/usr/bin/hostid
/usr/bin/hostnamectl
/usr/bin/i386
/usr/bin/iconv
/usr/bin/id
/usr/bin/infocmp
/usr/bin/infotocap
/usr/bin/install
/usr/bin/instmodsh
/usr/bin/ionice
/usr/bin/ipcmk
/usr/bin/ipcrm
/usr/bin/ipcs
/usr/bin/iptables-xml
/usr/bin/ischroot
/usr/bin/join
/usr/bin/jq
/usr/bin/json_pp
/usr/bin/kbxutil
/usr/bin/kernel-install
/usr/bin/killall
/usr/bin/last
/usr/bin/lastb
/usr/bin/lastlog
/usr/bin/lcf
/usr/bin/ld
/usr/bin/ld.bfd
/usr/bin/ld.gold
/usr/bin/ldd
/usr/bin/less
/usr/bin/lessecho
/usr/bin/lessfile
/usr/bin/lesskey
/usr/bin/lesspipe
/usr/bin/libnetcfg
/usr/bin/link
/usr/bin/linux32
/usr/bin/linux64
/usr/bin/locale
/usr/bin/localectl
/usr/bin/localedef
/usr/bin/logger
/usr/bin/logname
/usr/bin/lsattr
/usr/bin/lsb_release
/usr/bin/lscpu
/usr/bin/lsipc
/usr/bin/lslocks
/usr/bin/lslogins
/usr/bin/lsmem
/usr/bin/lsns
/usr/bin/lspgpot
/usr/bin/lzcat
/usr/bin/lzcmp
/usr/bin/lzdiff
/usr/bin/lzegrep
/usr/bin/lzfgrep
/usr/bin/lzgrep
/usr/bin/lzless
/usr/bin/lzma
/usr/bin/lzmainfo
/usr/bin/lzmore
/usr/bin/make
/usr/bin/make-first-existing-target
/usr/bin/mawk
/usr/bin/mcookie
/usr/bin/md5sum
/usr/bin/md5sum.textutils
/usr/bin/mesg
/usr/bin/migrate-pubring-from-classic-gpg
/usr/bin/mkfifo
/usr/bin/msgattrib
/usr/bin/msgcat
/usr/bin/msgcmp
/usr/bin/msgcomm
/usr/bin/msgconv
/usr/bin/msgen
/usr/bin/msgexec
/usr/bin/msgfilter
/usr/bin/msgfmt
/usr/bin/msggrep
/usr/bin/msginit
/usr/bin/msgmerge
/usr/bin/msgunfmt
/usr/bin/msguniq
/usr/bin/mtrace
/usr/bin/namei
/usr/bin/nawk
/usr/bin/newgrp
/usr/bin/ngettext
/usr/bin/nice
/usr/bin/nl
/usr/bin/nm
/usr/bin/nohup
/usr/bin/nproc
/usr/bin/nsenter
/usr/bin/numfmt
/usr/bin/objcopy
/usr/bin/objdump
/usr/bin/od
/usr/bin/openssl
/usr/bin/pager
/usr/bin/partx
/usr/bin/passwd
/usr/bin/paste
/usr/bin/patch
/usr/bin/pathchk
/usr/bin/pdb
/usr/bin/pdb2
/usr/bin/pdb2.7
/usr/bin/pdb3
/usr/bin/pdb3.7
/usr/bin/peekfd
/usr/bin/perl
/usr/bin/perl5.28-x86_64-linux-gnu
/usr/bin/perl5.28.1
/usr/bin/perlbug
/usr/bin/perldoc
/usr/bin/perlivp
/usr/bin/perlthanks
/usr/bin/pgrep
/usr/bin/piconv
/usr/bin/pidproxy
/usr/bin/pigz
/usr/bin/pinentry
/usr/bin/pinentry-curses
/usr/bin/pinky
/usr/bin/pkaction
/usr/bin/pkcheck
/usr/bin/pkcon
/usr/bin/pkexec
/usr/bin/pkill
/usr/bin/pkmon
/usr/bin/pkttyagent
/usr/bin/pl2pm
/usr/bin/pldd
/usr/bin/pmap
/usr/bin/pod2html
/usr/bin/pod2man
/usr/bin/pod2text
/usr/bin/pod2usage
/usr/bin/podchecker
/usr/bin/podselect
/usr/bin/pr
/usr/bin/print
/usr/bin/printenv
/usr/bin/printf
/usr/bin/prlimit
/usr/bin/prove
/usr/bin/prtstat
/usr/bin/pslog
/usr/bin/pstree
/usr/bin/pstree.x11
/usr/bin/ptar
/usr/bin/ptardiff
/usr/bin/ptargrep
/usr/bin/ptx
/usr/bin/pwdx
/usr/bin/py3clean
/usr/bin/py3compile
/usr/bin/py3versions
/usr/bin/pyclean
/usr/bin/pycompile
/usr/bin/pydoc
/usr/bin/pydoc2
/usr/bin/pydoc2.7
/usr/bin/pydoc3
/usr/bin/pydoc3.7
/usr/bin/pygettext
/usr/bin/pygettext2
/usr/bin/pygettext2.7
/usr/bin/pygettext3
/usr/bin/pygettext3.7
/usr/bin/python
/usr/bin/python2
/usr/bin/python2.7
/usr/bin/python3
/usr/bin/python3.7
/usr/bin/python3.7m
/usr/bin/python3m
/usr/bin/pyversions
/usr/bin/ranlib
/usr/bin/rcp
/usr/bin/readelf
/usr/bin/realpath
/usr/bin/recode-sr-latin
/usr/bin/rename.ul
/usr/bin/renice
/usr/bin/reset
/usr/bin/resizepart
/usr/bin/resolvectl
/usr/bin/rev
/usr/bin/rgrep
/usr/bin/rlogin
/usr/bin/rootlesskit
/usr/bin/rootlesskit-docker-proxy
/usr/bin/rpcgen
/usr/bin/rsh
/usr/bin/run-mailcap
/usr/bin/runc
/usr/bin/runcon
/usr/bin/savelog
/usr/bin/scp
/usr/bin/script
/usr/bin/scriptreplay
/usr/bin/sdiff
/usr/bin/see
/usr/bin/select-editor
/usr/bin/sensible-browser
/usr/bin/sensible-editor
/usr/bin/sensible-pager
/usr/bin/seq
/usr/bin/setarch
/usr/bin/setpriv
/usr/bin/setsid
/usr/bin/setterm
/usr/bin/sftp
/usr/bin/sg
/usr/bin/sha1sum
/usr/bin/sha224sum
/usr/bin/sha256sum
/usr/bin/sha384sum
/usr/bin/sha512sum
/usr/bin/shasum
/usr/bin/shred
/usr/bin/shuf
/usr/bin/size
/usr/bin/skill
/usr/bin/slabtop
/usr/bin/slogin
/usr/bin/snice
/usr/bin/sort
/usr/bin/sotruss
/usr/bin/splain
/usr/bin/split
/usr/bin/sprof
/usr/bin/ssh
/usr/bin/ssh-add
/usr/bin/ssh-agent
/usr/bin/ssh-argv0
/usr/bin/ssh-copy-id
/usr/bin/ssh-keygen
/usr/bin/ssh-keyscan
/usr/bin/stat
/usr/bin/stdbuf
/usr/bin/strings
/usr/bin/strip
/usr/bin/sudo
/usr/bin/sudoedit
/usr/bin/sudoreplay
/usr/bin/sum
/usr/bin/supervisorctl
/usr/bin/supervisord
/usr/bin/symcryptrun
/usr/bin/systemd-analyze
/usr/bin/systemd-cat
/usr/bin/systemd-cgls
/usr/bin/systemd-cgtop
/usr/bin/systemd-delta
/usr/bin/systemd-detect-virt
/usr/bin/systemd-id128
/usr/bin/systemd-mount
/usr/bin/systemd-path
/usr/bin/systemd-resolve
/usr/bin/systemd-run
/usr/bin/systemd-socket-activate
/usr/bin/systemd-stdio-bridge
/usr/bin/systemd-umount
/usr/bin/tabs
/usr/bin/tac
/usr/bin/tail
/usr/bin/taskset
/usr/bin/tee
/usr/bin/test
/usr/bin/tic
/usr/bin/timedatectl
/usr/bin/timeout
/usr/bin/tload
/usr/bin/toe
/usr/bin/top
/usr/bin/touch
/usr/bin/tput
/usr/bin/tr
/usr/bin/truncate
/usr/bin/tset
/usr/bin/tsort
/usr/bin/tty
/usr/bin/tzselect
/usr/bin/ucf
/usr/bin/ucfq
/usr/bin/ucfr
/usr/bin/unattended-upgrade
/usr/bin/unattended-upgrades
/usr/bin/unexpand
/usr/bin/uniq
/usr/bin/unlink
/usr/bin/unlzma
/usr/bin/unpigz
/usr/bin/unshare
/usr/bin/unxz
/usr/bin/unzip
/usr/bin/unzipsfx
/usr/bin/update-alternatives
/usr/bin/update-mime-database
/usr/bin/uptime
/usr/bin/users
/usr/bin/utmpdump
/usr/bin/vmstat
/usr/bin/w
/usr/bin/w.procps
/usr/bin/wall
/usr/bin/watch
/usr/bin/watchgnupg
/usr/bin/wc
/usr/bin/whereis
/usr/bin/which
/usr/bin/who
/usr/bin/whoami
/usr/bin/x86_64
/usr/bin/x86_64-linux-gnu-addr2line
/usr/bin/x86_64-linux-gnu-ar
/usr/bin/x86_64-linux-gnu-as
/usr/bin/x86_64-linux-gnu-c++filt
/usr/bin/x86_64-linux-gnu-cpp
/usr/bin/x86_64-linux-gnu-cpp-8
/usr/bin/x86_64-linux-gnu-dwp
/usr/bin/x86_64-linux-gnu-elfedit
/usr/bin/x86_64-linux-gnu-g++
/usr/bin/x86_64-linux-gnu-g++-8
/usr/bin/x86_64-linux-gnu-gcc
/usr/bin/x86_64-linux-gnu-gcc-8
/usr/bin/x86_64-linux-gnu-gcc-ar
/usr/bin/x86_64-linux-gnu-gcc-ar-8
/usr/bin/x86_64-linux-gnu-gcc-nm
/usr/bin/x86_64-linux-gnu-gcc-nm-8
/usr/bin/x86_64-linux-gnu-gcc-ranlib
/usr/bin/x86_64-linux-gnu-gcc-ranlib-8
/usr/bin/x86_64-linux-gnu-gcov
/usr/bin/x86_64-linux-gnu-gcov-8
/usr/bin/x86_64-linux-gnu-gcov-dump
/usr/bin/x86_64-linux-gnu-gcov-dump-8
/usr/bin/x86_64-linux-gnu-gcov-tool
/usr/bin/x86_64-linux-gnu-gcov-tool-8
/usr/bin/x86_64-linux-gnu-gold
/usr/bin/x86_64-linux-gnu-gprof
/usr/bin/x86_64-linux-gnu-ld
/usr/bin/x86_64-linux-gnu-ld.bfd
/usr/bin/x86_64-linux-gnu-ld.gold
/usr/bin/x86_64-linux-gnu-nm
/usr/bin/x86_64-linux-gnu-objcopy
/usr/bin/x86_64-linux-gnu-objdump
/usr/bin/x86_64-linux-gnu-ranlib
/usr/bin/x86_64-linux-gnu-readelf
/usr/bin/x86_64-linux-gnu-size
/usr/bin/x86_64-linux-gnu-strings
/usr/bin/x86_64-linux-gnu-strip
/usr/bin/xargs
/usr/bin/xauth
/usr/bin/xdg-user-dir
/usr/bin/xdg-user-dirs-update
/usr/bin/xgettext
/usr/bin/xsubpp
/usr/bin/xz
/usr/bin/xzcat
/usr/bin/xzcmp
/usr/bin/xzdiff
/usr/bin/xzegrep
/usr/bin/xzfgrep
/usr/bin/xzgrep
/usr/bin/xzless
/usr/bin/xzmore
/usr/bin/yes
/usr/bin/zdump
/usr/bin/zipdetails
/usr/bin/zipgrep
/usr/bin/zipinfo
/usr/local/bin
/usr/local/bin/docker-compose
/usr/local/sbin
/usr/sbin
/usr/sbin/aa-remove-unknown
/usr/sbin/aa-status
/usr/sbin/aa-teardown
/usr/sbin/add-shell
/usr/sbin/addgnupghome
/usr/sbin/addgroup
/usr/sbin/adduser
/usr/sbin/apparmor_status
/usr/sbin/applygnupgdefaults
/usr/sbin/arptables
/usr/sbin/arptables-nft
/usr/sbin/arptables-nft-restore
/usr/sbin/arptables-nft-save
/usr/sbin/arptables-restore
/usr/sbin/arptables-save
/usr/sbin/chgpasswd
/usr/sbin/chmem
/usr/sbin/chpasswd
/usr/sbin/chroot
/usr/sbin/cpgr
/usr/sbin/cppw
/usr/sbin/delgroup
/usr/sbin/deluser
/usr/sbin/dpkg-preconfigure
/usr/sbin/dpkg-reconfigure
/usr/sbin/e2freefrag
/usr/sbin/e4crypt
/usr/sbin/e4defrag
/usr/sbin/ebtables
/usr/sbin/ebtables-nft
/usr/sbin/ebtables-nft-restore
/usr/sbin/ebtables-nft-save
/usr/sbin/ebtables-restore
/usr/sbin/ebtables-save
/usr/sbin/fdformat
/usr/sbin/filefrag
/usr/sbin/groupadd
/usr/sbin/groupdel
/usr/sbin/groupmems
/usr/sbin/groupmod
/usr/sbin/grpck
/usr/sbin/grpconv
/usr/sbin/grpunconv
/usr/sbin/iconvconfig
/usr/sbin/invoke-rc.d
/usr/sbin/ip6tables
/usr/sbin/ip6tables-apply
/usr/sbin/ip6tables-legacy
/usr/sbin/ip6tables-legacy-restore
/usr/sbin/ip6tables-legacy-save
/usr/sbin/ip6tables-nft
/usr/sbin/ip6tables-nft-restore
/usr/sbin/ip6tables-nft-save
/usr/sbin/ip6tables-restore
/usr/sbin/ip6tables-restore-translate
/usr/sbin/ip6tables-save
/usr/sbin/ip6tables-translate
/usr/sbin/iptables
/usr/sbin/iptables-apply
/usr/sbin/iptables-legacy
/usr/sbin/iptables-legacy-restore
/usr/sbin/iptables-legacy-save
/usr/sbin/iptables-nft
/usr/sbin/iptables-nft-restore
/usr/sbin/iptables-nft-save
/usr/sbin/iptables-restore
/usr/sbin/iptables-restore-translate
/usr/sbin/iptables-save
/usr/sbin/iptables-translate
/usr/sbin/ldattach
/usr/sbin/mklost+found
/usr/sbin/newusers
/usr/sbin/nfnl_osf
/usr/sbin/nft
/usr/sbin/nologin
/usr/sbin/pam-auth-update
/usr/sbin/pam_getenv
/usr/sbin/pam_timestamp_check
/usr/sbin/policy-rc.d
/usr/sbin/pwck
/usr/sbin/pwconv
/usr/sbin/pwunconv
/usr/sbin/readprofile
/usr/sbin/remove-shell
/usr/sbin/rmt
/usr/sbin/rmt-tar
/usr/sbin/rtcwake
/usr/sbin/service
/usr/sbin/tarcat
/usr/sbin/tzconfig
/usr/sbin/update-ca-certificates
/usr/sbin/update-mime
/usr/sbin/update-passwd
/usr/sbin/update-rc.d
/usr/sbin/useradd
/usr/sbin/userdel
/usr/sbin/usermod
/usr/sbin/vigr
/usr/sbin/vipw
/usr/sbin/visudo
/usr/sbin/xtables-legacy-multi
/usr/sbin/xtables-monitor
/usr/sbin/xtables-nft-multi
/usr/sbin/zic
```

This was mostly a [fun exercise](https://unix.stackexchange.com/a/120943/158462) for myself to see if it could be done using one line of Python code without resorting to using the exec function. In a more readable form, and with some comments, the code looks like this:
```
import os
import sys

# This is just to have a function to output something on the screen.
# I'm using Python 2.7 in which 'print' is not a function and cannot
# be used in the 'map' function.
output = lambda(x) : sys.stdout.write(x + "\n")

# Get a list of the components in the PATH environment variable. Will
# abort the program is PATH doesn't exist
paths = os.environ["PATH"].split(":")

# os.listdir raises an error is something is not a path so I'm creating
# a small function that only executes it if 'p' is a directory
listdir = lambda(p) : os.listdir(p) if os.path.isdir(p) else [ ]

# Checks if the path specified by x[0] and x[1] is a file
isfile = lambda(x) : True if os.path.isfile(os.path.join(x[0],x[1])) else False

# Checks if the path specified by x[0] and x[1] has the executable flag set
isexe = lambda(x) : True if os.access(os.path.join(x[0],x[1]), os.X_OK) else False

# Here, I'm using a list comprehension to build a list of all executable files
# in the PATH, and abusing the map function to write every name in the resulting
# list to the screen.
map(output, [ os.path.join(p,f) for p in paths for f in listdir(p) if isfile((p,f)) and isexe((p,f)) ])
```

If you can run Python 2 in your shell, the following (ridiculously long) one-liner can be used as well:

```
$ python2 -c 'import os;import sys;output = lambda(x) : sys.stdout.write(x + "\n"); paths = os.environ["PATH"].split(":") ; listdir = lambda(p) : os.listdir(p) if os.path.isdir(p) else [ ] ; isfile = lambda(x) : True if os.path.isfile(os.path.join(x[0],x[1])) else False ; isexe = lambda(x) : True if os.access(os.path.join(x[0],x[1]), os.X_OK) else False ; map(output,[ os.path.join(p,f) for p in paths for f in listdir(p) if isfile((p,f)) and isexe((p,f)) ])'
```

### Packages

If we need to [list the installed packages in the Python](https://stackoverflow.com/a/73958089/4058484) shell, For terminal I recommend help("modules") or python -c "help('modules')".

```
$ python3.7 -c 'help("modules")'

Please wait a moment while I gather a list of all available modules...

__future__          _tracemalloc        getopt              rlcompleter
_abc                _uuid               getpass             runpy
_ast                _warnings           gettext             sched
_asyncio            _weakref            gi                  secrets
_bisect             _weakrefset         glob                select
_blake2             _xxtestfuzz         grp                 selectors
_bootlocale         abc                 gzip                shelve
_bz2                aifc                hashlib             shlex
_codecs             antigravity         heapq               shutil
_codecs_cn          apt                 hmac                signal
_codecs_hk          apt_inst            html                site
_codecs_iso2022     apt_pkg             http                sitecustomize
_codecs_jp          aptsources          imaplib             smtpd
_codecs_kr          argparse            imghdr              smtplib
_codecs_tw          array               imp                 sndhdr
_collections        ast                 importlib           socket
_collections_abc    asynchat            inspect             socketserver
_compat_pickle      asyncio             io                  softwareproperties
_compression        asyncore            ipaddress           spwd
_contextvars        atexit              itertools           sqlite3
_crypt              audioop             json                sre_compile
_csv                base64              keyword             sre_constants
_ctypes             bdb                 linecache           sre_parse
_ctypes_test        binascii            locale              ssl
_curses             binhex              logging             stat
_curses_panel       bisect              lsb_release         statistics
_datetime           builtins            lzma                string
_dbm                bz2                 macpath             stringprep
_dbus_bindings      cProfile            mailbox             struct
_dbus_glib_bindings calendar            mailcap             subprocess
_decimal            cgi                 marshal             sunau
_dummy_thread       cgitb               math                symbol
_elementtree        chunk               mimetypes           symtable
_functools          cmath               mmap                sys
_hashlib            cmd                 modulefinder        sysconfig
_heapq              code                multiprocessing     syslog
_imp                codecs              netrc               tabnanny
_io                 codeop              nis                 tarfile
_json               collections         nntplib             telnetlib
_locale             colorsys            ntpath              tempfile
_lsprof             compileall          nturl2path          termios
_lzma               concurrent          numbers             test
_markupbase         configparser        opcode              textwrap
_md5                contextlib          operator            this
_multibytecodec     contextvars         optparse            threading
_multiprocessing    copy                os                  time
_opcode             copyreg             ossaudiodev         timeit
_operator           crypt               parser              token
_osx_support        csv                 pathlib             tokenize
_pickle             ctypes              pdb                 trace
_posixsubprocess    curl                pickle              traceback
_py_abc             curses              pickletools         tracemalloc
_pydecimal          dataclasses         pipes               tty
_pyio               datetime            pkgutil             turtle
_queue              dbm                 platform            types
_random             dbus                plistlib            typing
_sha1               decimal             poplib              unicodedata
_sha256             difflib             posix               unittest
_sha3               dis                 posixpath           urllib
_sha512             distro_info         pprint              uu
_signal             distutils           profile             uuid
_sitebuiltins       doctest             pstats              venv
_socket             dummy_threading     pty                 warnings
_sqlite3            email               pwd                 wave
_sre                encodings           py_compile          weakref
_ssl                enum                pyclbr              webbrowser
_stat               errno               pycurl              wsgiref
_string             faulthandler        pydoc               xdrlib
_strptime           fcntl               pydoc_data          xml
_struct             filecmp             pyexpat             xmlrpc
_symtable           fileinput           pygtkcompat         xxlimited
_sysconfigdata_m_linux_x86_64-linux-gnu fnmatch             queue
_testbuffer         formatter           quopri              zipapp
_testcapi           fractions           random              zipfile
_testimportmultiple ftplib              re                  zipimport
_testmultiphase     functools           readline            zlib
_thread             gc                  reprlib             xxsubtype
_threading_local    genericpath         resource

Enter any module name to get more help.  Or, type "modules spam" to search
for modules whose name or summary contain the string "spam".
```

I'm comparing five methods to retrieve installed "modules", all of which I've seen in this thread

```
                                iter_modules help("modules") builtin_module_names pip list working_set
Includes distributions               ❌            ❌                ❌               ✔️         ✔️
Includes modules (No built-in)       ✔️            ✔️                ❌               ❌         ❌
Includes built-in modules            ❌            ✔️                ✔️               ❌         ❌
Includes frozen                      ✔️            ✔️                ❌               ❌         ❌
Includes venv                        ✔️            ✔️                ❌               ✔️         ✔️
Includes global	                     ✔️            ✔️                ❌               ✔️         ✔️
Includes editable installs           ✔️            ✔️                ❌               ✔️         ✔️
Includes PyCharm helpers             ✔️            ❌                ❌               ❌         ❌
Lowers capital letters               ❌            ❌                ❌               ❌         ✔️
Time taken (665 modules total)    53.7 msec    1.03 sec           577 nsec         284 msec  36.2 usec
```
For programmatically I recommend iter_modules + builtin_module_names to pluck the module name out of the tuples generated by [pkgutil.iter_modules()](http://docs.python.org/library/pkgutil.html#pkgutil.iter_modules) It is however very convoluted with information

```
$ python -c 'import pkgutil;print [x[1] for x in list(pkgutil.iter_modules())]'

['BaseHTTPServer', 'Bastion', 'CGIHTTPServer', 'ConfigParser', 'Cookie', 'DocXMLRPCServer', 'HTMLParser', 
'MimeWriter', 'Queue', 'SimpleHTTPServer', 'SimpleXMLRPCServer', 'SocketServer', 'StringIO', 'UserDict', 
'UserList', 'UserString', '_LWPCookieJar', '_MozillaCookieJar', '__future__', '_abcoll', '_osx_support', 
'_pyio', '_strptime', '_sysconfigdata', '_threading_local', '_weakrefset', 'abc', 'aifc', 'antigravity', 
'anydbm', 'argparse', 'ast', 'asynchat', 'asyncore', 'atexit', 'audiodev', 'base64', 'bdb', 'binhex', 
'bisect', 'bsddb', 'cProfile', 'calendar', 'cgi', 'cgitb', 'chunk', 'cmd', 'code', 'codecs', 'codeop', 
'collections', 'colorsys', 'commands', 'compileall', 'compiler', 'contextlib', 'cookielib', 'copy', 
'copy_reg', 'csv', 'ctypes', 'curses', 'dbhash', 'decimal', 'difflib', 'dircache', 'dis', 'distutils', 
'doctest', 'dumbdbm', 'dummy_thread', 'dummy_threading', 'email', 'encodings', 'ensurepip', 'filecmp', 
'fileinput', 'fnmatch', 'formatter', 'fpformat', 'fractions', 'ftplib', 'functools', 'genericpath', 
'getopt', 'getpass', 'gettext', 'glob', 'gzip', 'hashlib', 'heapq', 'hmac', 'hotshot', 'htmlentitydefs', 
'htmllib', 'httplib', 'ihooks', 'imaplib', 'imghdr', 'importlib', 'imputil', 'inspect', 'io', 'json', 
'keyword', 'lib2to3', 'linecache', 'locale', 'logging', 'macpath', 'macurl2path', 'mailbox', 'mailcap', 
'markupbase', 'md5', 'mhlib', 'mimetools', 'mimetypes', 'mimify', 'modulefinder', 'multifile', 
'multiprocessing', 'mutex', 'netrc', 'new', 'nntplib', 'ntpath', 'nturl2path', 'numbers', 'opcode', 
'optparse', 'os', 'os2emxpath', 'pdb', 'pickle', 'pickletools', 'pipes', 'pkgutil', 'platform', 
'plistlib', 'popen2', 'poplib', 'posixfile', 'posixpath', 'pprint', 'profile', 'pstats', 'pty', 
'py_compile', 'pyclbr', 'pydoc', 'pydoc_data', 'quopri', 'random', 're', 'repr', 'rexec', 'rfc822', 
'rlcompleter', 'robotparser', 'runpy', 'sched', 'sets', 'sgmllib', 'sha', 'shelve', 'shlex', 'shutil', 
'site', 'sitecustomize', 'smtpd', 'smtplib', 'sndhdr', 'socket', 'sqlite3', 'sre', 'sre_compile', 
'sre_constants', 'sre_parse', 'ssl', 'stat', 'statvfs', 'string', 'stringold', 'stringprep', 'struct', 
'subprocess', 'sunau', 'sunaudio', 'symbol', 'symtable', 'sysconfig', 'tabnanny', 'tarfile', 'telnetlib', 
'tempfile', 'test', 'textwrap', 'this', 'threading', 'timeit', 'toaiff', 'token', 'tokenize', 'trace', 
'traceback', 'tty', 'types', 'unittest', 'urllib', 'urllib2', 'urlparse', 'user', 'uu', 'uuid', 'warnings', 
'wave', 'weakref', 'webbrowser', 'whichdb', 'wsgiref', 'xdrlib', 'xml', 'xmllib', 'xmlrpclib', 'zipfile', 
'CDROM', 'DLFCN', 'IN', 'TYPES', '_sysconfigdata_nd', 'Canvas', 'Dialog', 'FileDialog', 'FixTk', 
'ScrolledText', 'SimpleDialog', 'Tix', 'Tkconstants', 'Tkdnd', 'Tkinter', 'tkColorChooser', 'tkCommonDialog', 
'tkFileDialog', 'tkFont', 'tkMessageBox', 'tkSimpleDialog', 'ttk', 'turtle', '_bsddb', '_codecs_cn', 
'_codecs_hk', '_codecs_iso2022', '_codecs_jp', '_codecs_kr', '_codecs_tw', '_csv', '_ctypes', '_ctypes_test', 
'_curses', '_curses_panel', '_elementtree', '_hashlib', '_hotshot', '_json', '_lsprof', '_multibytecodec', 
'_multiprocessing', '_sqlite3', '_ssl', '_testcapi', 'audioop', 'bz2', 'crypt', 'dbm', 'future_builtins', 
'linuxaudiodev', 'mmap', 'nis', 'ossaudiodev', 'parser', 'pyexpat', 'readline', 'resource', 'termios', 
'lsb_release', 'meld3', 'pkg_resources', 'supervisor']
```
