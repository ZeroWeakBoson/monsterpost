## System Storage

GitHub allows developers to run GitHub Actions workflows on your own runners. This [Docker image](https://hub.docker.com/r/tcardonne/github-runner#!) allows you to create your own runners on Docker, you can enable Docker siblings by binding the host Docker daemon socket.

```
$ cat /etc/os-release

PRETTY_NAME="Debian GNU/Linux 10 (buster)"
NAME="Debian GNU/Linux"
VERSION_ID="10"
VERSION="10 (buster)"
VERSION_CODENAME=buster
ID=debian
HOME_URL="https://www.debian.org/"
SUPPORT_URL="https://www.debian.org/support"
BUG_REPORT_URL="https://bugs.debian.org/"
```

By default, the df command shows the disk space used and available disk space in kilobytes. To display information about disk drives in human-readable format (kilobytes, megabytes, gigabytes and so on), invoke the df command with the -h option

```
$ df -h
Filesystem      Size  Used Avail Use% Mounted on
/dev/root       2.0G  1.1G  902M  54% /
devtmpfs        484M     0  484M   0% /dev
tmpfs           487M     0  487M   0% /dev/shm
tmpfs           195M  512K  195M   1% /run
tmpfs           487M  112K  487M   1% /etc/machine-id
tmpfs           256K     0  256K   0% /mnt/disks
tmpfs           487M     0  487M   0% /tmp
overlayfs       487M  112K  487M   1% /etc
/dev/sda8        11M   24K   11M   1% /usr/share/oem
/dev/sda1       5.7G  3.5G  2.2G  62% /mnt/stateful_partition
tmpfs           2.0M  128K  1.9M   7% /var/lib/cloud
/dev/sdb1        49G  9.9G   38G  22% /mnt/disks/Linux              ◄- DEEP LEARNING
```

On Unix-like operating systems, the set command is a built-in function of the Bourne shell ( sh ), C shell ( csh ), and Korn shell ( ksh ), which is used to define and determine the values of the system environment.

```
$ set

ACTIONS_ID_TOKEN_REQUEST_TOKEN=***
ACTIONS_ID_TOKEN_REQUEST_URL='https://pipelines.actions.githubusercontent.com/a18hGIuIy4qbY5KTUvkKiuBNsSHDVCEtnJ8x8NEYFPEBFH2tOZ/00000000-0000-0000-0000-000000000000/_apis/distributedtask/hubs/Actions/plans/7534b9e1-5505-4cff-9f7a-440ad58fadf5/jobs/55c239b7-523f-5586-aeb6-60a00c959946/idtoken?api-version=2.0'
AGENT_TOOLSDIRECTORY=/opt/hostedtoolcache
BASH=/bin/bash
BASHOPTS=checkwinsize:cmdhist:complete_fullquote:extquote:force_fignore:globasciiranges:hostcomplete:interactive_comments:progcomp:promptvars:sourcepath
BASH_ALIASES=()
BASH_ARGC=()
BASH_ARGV=()
BASH_CMDS=()
BASH_LINENO=([0]="0")
BASH_SOURCE=([0]="/home/runner/_work/_temp/b00557e9-dc1d-40fb-a211-db6869b65693.sh")
BASH_VERSINFO=([0]="5" [1]="0" [2]="3" [3]="1" [4]="release" [5]="x86_64-pc-linux-gnu")
BASH_VERSION='5.0.3(1)-release'
CI=true
DIRSTACK=()
EUID=0
GITHUB_ACCESS_TOKEN=***
GITHUB_ACTION=__run
GITHUB_ACTIONS=true
GITHUB_ACTION_REF=
GITHUB_ACTION_REPOSITORY=
GITHUB_ACTOR=eq19
GITHUB_ACTOR_ID=8466209
GITHUB_API_URL=https://api.github.com
GITHUB_BASE_REF=
GITHUB_ENV=/home/runner/_work/_temp/_runner_file_commands/set_env_acae127c-173c-43fd-abea-f6d3fe882641
GITHUB_EVENT_NAME=push
GITHUB_EVENT_PATH=/home/runner/_work/_temp/_github_workflow/event.json
GITHUB_GRAPHQL_URL=https://api.github.com/graphql
GITHUB_HEAD_REF=
GITHUB_JOB=github-pages
GITHUB_OUTPUT=/home/runner/_work/_temp/_runner_file_commands/set_output_acae127c-173c-43fd-abea-f6d3fe882641
GITHUB_PATH=/home/runner/_work/_temp/_runner_file_commands/add_path_acae127c-173c-43fd-abea-f6d3fe882641
GITHUB_REF=refs/heads/eQ19
GITHUB_REF_NAME=eQ19
GITHUB_REF_PROTECTED=false
GITHUB_REF_TYPE=branch
GITHUB_REPOSITORY=FeedMapping/Partition
GITHUB_REPOSITORY_ID=550855238
GITHUB_REPOSITORY_OWNER=FeedMapping
GITHUB_REPOSITORY_OWNER_ID=11927583
GITHUB_RETENTION_DAYS=90
GITHUB_RUN_ATTEMPT=1
GITHUB_RUN_ID=4975344786
GITHUB_RUN_NUMBER=88
GITHUB_SERVER_URL=https://github.com
GITHUB_SHA=a5ee1d5f656adf586a43252afce0a4ddc838ade4
GITHUB_STATE=/home/runner/_work/_temp/_runner_file_commands/save_state_acae127c-173c-43fd-abea-f6d3fe882641
GITHUB_STEP_SUMMARY=/home/runner/_work/_temp/_runner_file_commands/step_summary_acae127c-173c-43fd-abea-f6d3fe882641
GITHUB_TRIGGERING_ACTOR=eq19
GITHUB_WORKFLOW='Build and deploy Jekyll site'
GITHUB_WORKFLOW_REF=FeedMapping/Partition/.github/workflows/github-pages.yml@refs/heads/eQ19
GITHUB_WORKFLOW_SHA=a5ee1d5f656adf586a43252afce0a4ddc838ade4
GITHUB_WORKSPACE=/home/runner/_work/Partition/Partition
GROUPS=()
HOME=/root
HOSTNAME=ef75abdc2b19
HOSTTYPE=x86_64
IFS=$' \t\n'
MACHTYPE=x86_64-pc-linux-gnu
OPTERR=1
OPTIND=1
OSTYPE=linux-gnu
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
PIPESTATUS=([0]="0")
PPID=17188
PS4='+ '
***
RUNNER_ALLOW_RUNASROOT=true
RUNNER_ARCH=X64
RUNNER_LABELS=
RUNNER_NAME=Google-optimized-instance
RUNNER_ORGANIZATION_URL=https://github.com/FeedMapping
RUNNER_OS=Linux
RUNNER_REPLACE_EXISTING=true
RUNNER_REPOSITORY_URL=
RUNNER_TEMP=/home/runner/_work/_temp
RUNNER_TOKEN=ACAS6IJKEQK3RSYCNEQ3Z53EL2JM6
RUNNER_TOOL_CACHE=/opt/hostedtoolcache
RUNNER_TRACKING_ID=github_b2590dca-5a63-4f9a-a8e2-68924e311fdc
RUNNER_WORKSPACE=/home/runner/_work/Partition
RUNNER_WORK_DIRECTORY=_work
SHELL=/bin/bash
SHELLOPTS=braceexpand:errexit:hashall:interactive-comments
SHLVL=1
SUPERVISOR_ENABLED=1
SUPERVISOR_GROUP_NAME=runner
SUPERVISOR_PROCESS_NAME=runner
TERM=dumb
UID=0
_=-V
```

[![docker-github-runner](https://user-images.githubusercontent.com/8466209/229943878-e3d1cae4-15fd-43ab-9d7f-904a343b745c.png)](https://github.com/eq19/setup)


```
docker info
docker --version

docker logout
docker login

git clone https://github.com/eq19/setup
cd setup/docker
docker build -t setup .

docker images
docker tag setup:latest eq19/setup:latest

docker push eq19/setup:latest
```

For now, there are only Debian Buster (tagged with latest and vX.Y.Z) and Ubuntu Focal (tagged with ubuntu-20.04 and vX.Y.Z-ubuntu-20.04) images, but I may add more variants in the future. Feel free to create an issue if you want another base image.

[![default](https://user-images.githubusercontent.com/8466209/238171580-d65c5bcb-7ae9-498d-841f-b645e08c49b2.png)](https://registry.hub.docker.com/r/tcardonne/github-runner/tags)

When comparing Chromium OS vs Debian GNU/Linux, the Slant community recommends Debian GNU/Linux for most people. In the question“What are the best Linux distributions for desktops?” Debian GNU/Linux is ranked 3rd while Chromium OS is ranked 88th. The most important reason people chose Debian GNU/Linux is:

> Debian offers stable and testing CD images specifically built for GNOME (the default), KDE Plasma Workspaces, Xfce and LXDE. Less common window managers such as Enlightenment, Openbox, Fluxbox, GNUstep, IceWM, Window Maker and others can also be installed _([Slant](https://www.slant.co/versus/2691/2692/~chromium-os_vs_debian-gnu-linux))_.

[![chromium-os_vs_debian-gnu-linux](https://user-images.githubusercontent.com/8466209/238179595-7f087116-910c-4cf9-8b1b-1051e74f93d4.png)](https://www.slant.co/versus/2691/2692/~chromium-os_vs_debian-gnu-linux)

For most frameworks, Debian 10 is the default OS. Ubuntu 20.04 images are available for some frameworks. They are denoted by the -ubuntu-2004 suffixes in the image family name (see [Listing all available versions](https://cloud.google.com/deep-learning-vm/docs/images#listing-versions)). Debian 9 images have been deprecated.

[![Deep Learning VM Images
](https://user-images.githubusercontent.com/8466209/238179451-d71d776a-883f-4978-b60a-50a25a6c8572.png)](https://cloud.google.com/deep-learning-vm/docs/images#choosing_an_operating_system)

You can pull a container image and show the "[history](https://stackoverflow.com/a/75291419/2023941)" for the container. This shows you how it is built and what the original starting image. This does not mean that you access the original image. You can add to and remove parts of the image. You can also export an image to a tar archive file, modify and then reimport

```
{% raw %}
$ docker history  gcr.io/deeplearning-platform-release/tf-cpu:m96 --format  " {{.CreatedBy}}" --no-trunc

RUN |2 VERSION=1-15 CONTAINER_NAME=tf-cpu/1-15 /bin/sh -c cd /opt/google/licenses &&     chmod +x query_licenses.sh &&     ./query_licenses.sh # buildkit
RUN |2 VERSION=1-15 CONTAINER_NAME=tf-cpu/1-15 /bin/sh -c BAZEL_INSTALLER_URL="https://github.com/bazelbuild/bazel/releases/download/0.19.0/bazel-0.19.0-installer-linux-x86_64.sh" &&     BAZEL_INSTALLER_FILE="bazel_installer.sh" &&     wget -q "${BAZEL_INSTALLER_URL}" -O "${BAZEL_INSTALLER_FILE}" &&     chmod +x "${BAZEL_INSTALLER_FILE}" &&     "./${BAZEL_INSTALLER_FILE}" &&     rm -rf "./${BAZEL_INSTALLER_FILE}" # buildkit
RUN |2 VERSION=1-15 CONTAINER_NAME=tf-cpu/1-15 /bin/sh -c export CONDA_REPOSITORY="/tmp/conda" &&     chmod +x /opt/google/conda/install_to_env.sh &&     ENV_DOCKER=1 /opt/google/conda/install_to_env.sh base dlenv-tf-${VERSION}-cpu-meta # buildkit
ENV KMP_SETTINGS=1
ENV KMP_AFFINITY=granularity=fine,verbose,compact,1,0
ENV KMP_BLOCKTIME=0
ENV CONTAINER_NAME=tf-cpu/1-15
ARG CONTAINER_NAME
LABEL com.google.environment=Container: TensorFlow 1-15
ARG VERSION
CMD ["/run_jupyter.sh"]
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c chmod +x run_jupyter.sh # buildkit
COPY build/container/run_jupyter.sh /run_jupyter.sh # buildkit
ENTRYPOINT ["/entrypoint.sh"]
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c chmod +x entrypoint.sh # buildkit
COPY build/container/entrypoint.sh /entrypoint.sh # buildkit
COPY build/package/conda/channels.json /opt/google/conda/channels.json # buildkit
COPY build/package/packages/jupyter/jupyter_notebook_config.py /opt/jupyter/.jupyter/jupyter_notebook_config.py # buildkit
COPY build/package/packages/jupyter/ipython_kernel_config.py /etc/ipython/ipython_kernel_config.py # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c chown -R "jupyter:jupyter" "/home/jupyter/." # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c adduser --uid 1000 --gid 1001 jupyter # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c addgroup --gid 1001 jupyter # buildkit
ENV LD_LIBRARY_PATH=/usr/local/cuda/lib64:/usr/local/cuda/lib:/usr/local/lib/x86_64-linux-gnu:/usr/local/nvidia/lib:/usr/local/nvidia/lib64:
VOLUME [/home/jupyter]
EXPOSE map[8080/tcp:{}]
ENV SHELL=/bin/bash
ENV PATH=/opt/conda/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c chmod +x /opt/google/conda/provision_conda.sh && /opt/google/conda/provision_conda.sh # buildkit
ENV DL_ANACONDA_HOME=/opt/conda
ENV ANACONDA_PYTHON_VERSION=3.7
COPY build/vm/packer/generic/packages /opt/google # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c cd / &&     gsutil cp -r gs://dl-platform-binaries-builds/openmpi-4.0.2/v20191105/openmpi.tar.gz  . &&     tar xf openmpi.tar.gz &&     rm -f openmpi.tar.gz # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c apt update -y &&     apt install -y libnuma-dev # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c if dpkg -s libnccl2; then         echo "deb https://packages.cloud.google.com/apt google-fast-socket main" | tee /etc/apt/sources.list.d/google-fast-socket.list &&         curl -s -L https://packages.cloud.google.com/apt/doc/apt-key.gpg | apt-key add - &&         apt-get --allow-releaseinfo-change update && apt install -y google-fast-socket;     fi # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c apt-get --allow-releaseinfo-change update -y &&     apt-get install -y dirmngr &&     apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 8B57C5C2836F4BEB &&     apt-key adv --keyserver keyserver.ubuntu.com --recv-keys FEEA9169307EA071 &&     apt-get --allow-releaseinfo-change update -y &&     echo "deb [signed-by=/usr/share/keyrings/cloud.google.gpg] https://packages.cloud.google.com/apt cloud-sdk main" | tee -a /etc/apt/sources.list.d/google-cloud-sdk.list &&     curl https://packages.cloud.google.com/apt/doc/apt-key.gpg | apt-key --keyring /usr/share/keyrings/cloud.google.gpg add - &&     apt-get --allow-releaseinfo-change update -y &&     apt-get install -y apt-transport-https ca-certificates gnupg &&     echo "deb http://packages.cloud.google.com/apt gcsfuse-focal main" | tee /etc/apt/sources.list.d/gcsfuse.list &&     curl https://packages.cloud.google.com/apt/doc/apt-key.gpg | apt-key add - &&     apt-get --allow-releaseinfo-change update -y &&     apt-get install -y google-cloud-sdk && apt-get install -y gcsfuse &&     rm -rf /var/lib/apt/lists/* # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c apt-get --allow-releaseinfo-change -o Acquire::Check-Valid-Until=false update -y &&     apt-get install --no-install-recommends -y -q        $(grep -vE "^\s*#" aptget-requirements.txt | tr "\n" " ") &&     rm -rf /var/lib/apt/lists/* &&     rm -rf aptget-requirements.txt # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c if [ "${BASE_IMAGE}" =~ "^nvidia. *" ]; then       apt update -y || true && apt install -y wget && apt install -yq software-properties-common &&       wget https://developer.download.nvidia.com/compute/cuda/repos/ubuntu2004/x86_64/cuda-ubuntu2004.pin &&       mv cuda-ubuntu2004.pin /etc/apt/preferences.d/cuda-repository-pin-600 &&       apt-key adv --fetch-keys https://developer.download.nvidia.com/compute/cuda/repos/ubuntu2004/x86_64/3bf863cc.pub &&       add-apt-repository "deb https://developer.download.nvidia.com/compute/cuda/repos/ubuntu2004/x86_64/ /" &&       apt-get --allow-releaseinfo-change update;     fi # buildkit
COPY build/vm/packer/base/aptget-requirements.txt /aptget-requirements.txt # buildkit
RUN |1 DEBIAN_FRONTEND=noninteractive /bin/sh -c apt update --allow-releaseinfo-change -y &&     apt upgrade -y # buildkit
ARG DEBIAN_FRONTEND=noninteractive
ENV LANG=C.UTF-8
ENV LC_ALL=C.UTF-8
LABEL com.google.environment=Container: Minimal
{% endraw %}
```
![Untitled](https://user-images.githubusercontent.com/8466209/255381318-7cd95f34-ee40-4d02-bea8-3d72ff9bb4af.png)

![default](https://user-images.githubusercontent.com/8466209/198933143-1d783ccf-22a1-4415-9a11-8effe98d1741.png)

![default](https://user-images.githubusercontent.com/8466209/198837916-57284efa-bdb7-42d8-80f6-584b3c3bbd19.png)

![default](https://user-images.githubusercontent.com/8466209/198934268-1570c3cc-5a90-48b3-a1e6-b016c2d93ab4.png)
