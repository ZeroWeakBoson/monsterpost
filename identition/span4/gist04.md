## Directory Structure

This page walks through the steps required to [train an object detection model](https://github.com/tensorflow/models/blob/master/research/object_detection/g3doc/tf2_training_and_evaluation.md) with Recommended Directory Structure for Training and Evaluation for [tf2_ai_platform](https://github.com/tensorflow/models/blob/master/research/object_detection/dockerfiles/tf2_ai_platform/Dockerfile)

```
$ cat /mnt/disks/Linux/usr/share/models/research/object_detection/dockerfiles/tf2_ai_platform/Dockerfile

FROM tensorflow/tensorflow:latest-gpu

ARG DEBIAN_FRONTEND=noninteractive

# Install apt dependencies
RUN apt-get update && apt-get install -y \
    git \
    gpg-agent \
    python3-cairocffi \
    protobuf-compiler \
    python3-pil \
    python3-lxml \
    python3-tk \
    python3-opencv \
    wget

# Installs google cloud sdk, this is mostly for using gsutil to export model.
RUN wget -nv \
    https://dl.google.com/dl/cloudsdk/release/google-cloud-sdk.tar.gz && \
    mkdir /root/tools && \
    tar xvzf google-cloud-sdk.tar.gz -C /root/tools && \
    rm google-cloud-sdk.tar.gz && \
    /root/tools/google-cloud-sdk/install.sh --usage-reporting=false \
        --path-update=false --bash-completion=false \
        --disable-installation-options && \
    rm -rf /root/.config/* && \
    ln -s /root/.config /config && \
    rm -rf /root/tools/google-cloud-sdk/.install/.backup

# Path configuration
ENV PATH $PATH:/root/tools/google-cloud-sdk/bin
# Make sure gsutil will use the default service account
RUN echo '[GoogleCompute]\nservice_account = default' > /etc/boto.cfg

WORKDIR /home/tensorflow

## Copy this code (make sure you are under the ../models/research directory)
COPY . /home/tensorflow/models

# Compile protobuf configs
RUN (cd /home/tensorflow/models/ && protoc object_detection/protos/*.proto --python_out=.)
WORKDIR /home/tensorflow/models/

RUN cp object_detection/packages/tf2/setup.py ./
ENV PATH="/home/tensorflow/.local/bin:${PATH}"

RUN python -m pip install -U pip
RUN python -m pip install .

ENTRYPOINT ["python", "object_detection/model_main_tf2.py"]
```

GitHub allows developers to run GitHub Actions workflows on your own runners. This Docker image allows you to create your own runners on Docker. The GitHub runner (the binary) will update itself when receiving a job, if a new release is available. 

```
ARG FROM=debian:buster-slim
FROM ${FROM}

ARG DEBIAN_FRONTEND=noninteractive
ARG GIT_VERSION="2.26.2"
ARG GH_RUNNER_VERSION
ARG DOCKER_COMPOSE_VERSION="1.27.4"

ENV RUNNER_NAME=""
ENV RUNNER_WORK_DIRECTORY="_work"
ENV RUNNER_TOKEN=""
ENV RUNNER_REPOSITORY_URL=""
ENV RUNNER_LABELS=""
ENV RUNNER_ALLOW_RUNASROOT=true
ENV GITHUB_ACCESS_TOKEN=""
ENV AGENT_TOOLSDIRECTORY=/opt/hostedtoolcache

# Labels.
LABEL maintainer="me@tcardonne.fr" \
    org.label-schema.schema-version="1.0" \
    org.label-schema.build-date=$BUILD_DATE \
    org.label-schema.vcs-ref=$VCS_REF \
    org.label-schema.name="tcardonne/github-runner" \
    org.label-schema.description="Dockerized GitHub Actions runner." \
    org.label-schema.url="https://github.com/tcardonne/docker-github-runner" \
    org.label-schema.vcs-url="https://github.com/tcardonne/docker-github-runner" \
    org.label-schema.vendor="Thomas Cardonne" \
    org.label-schema.docker.cmd="docker run -it tcardonne/github-runner:latest"

RUN DEBIAN_FRONTEND=noninteractive apt-get update && \
    apt-get install -y \
        curl \
        unzip \
        apt-transport-https \
        ca-certificates \
        software-properties-common \
        sudo \
        supervisor \
        jq \
        iputils-ping \
        build-essential \
        zlib1g-dev \
        gettext \
        liblttng-ust0 \
        libcurl4-openssl-dev \
        openssh-client && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod 644 /etc/supervisor/conf.d/supervisord.conf

# Install Docker CLI
RUN curl -fsSL https://get.docker.com -o- | sh && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean

# Install Docker-Compose
RUN curl -L -o /usr/local/bin/docker-compose \
    "https://github.com/docker/compose/releases/download/${DOCKER_COMPOSE_VERSION}/docker-compose-$(uname -s)-$(uname -m)" && \
    chmod +x /usr/local/bin/docker-compose

RUN cd /tmp && \
    curl -sL -o git.tgz \
    https://www.kernel.org/pub/software/scm/git/git-${GIT_VERSION}.tar.gz && \
    tar zxf git.tgz  && \
    cd git-${GIT_VERSION}  && \
    ./configure --prefix=/usr  && \
    make && \
    make install && \
    rm -rf /tmp/*

RUN mkdir -p /home/runner ${AGENT_TOOLSDIRECTORY}

WORKDIR /home/runner

RUN GH_RUNNER_VERSION=${GH_RUNNER_VERSION:-$(curl --silent "https://api.github.com/repos/actions/runner/releases/latest" | grep tag_name | sed -E 's/.*"v([^"]+)".*/\1/')} \
    && curl -L -O https://github.com/actions/runner/releases/download/v${GH_RUNNER_VERSION}/actions-runner-linux-x64-${GH_RUNNER_VERSION}.tar.gz \
    && tar -zxf actions-runner-linux-x64-${GH_RUNNER_VERSION}.tar.gz \
    && rm -f actions-runner-linux-x64-${GH_RUNNER_VERSION}.tar.gz \
    && ./bin/installdependencies.sh \
    && chown -R root: /home/runner \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
```

In order to allow the runner to exit and restart by itself, the binary is started by a [supervisord process](https://github.com/tcardonne/docker-github-runner/blob/master/docker/Dockerfile) and [entrypoint](https://github.com/tcardonne/docker-github-runner/blob/master/docker/entrypoint.sh).

```
$ cat /etc/supervisord.conf

[supervisord]
user=root
nodaemon=true
logfile=/dev/fd/1
logfile_maxbytes=0
loglevel=error

[program:runner]
directory=/home/runner
command=/home/runner/bin/runsvc.sh
stdout_logfile=/dev/fd/1
stdout_logfile_maxbytes=0
redirect_stderr=true
```

The self-hosted runner application creates a detailed log file for each job that it processes. These files are stored in the _diag directory where you installed the runner application, and the filename begins with Worker_.

```
$ cat /home/runner/_diag/Runner_20230515-184422-utc.log

[2023-05-15 18:44:22Z INFO HostContext] No proxy settings were found based on environmental variables (http_proxy/https_proxy/HTTP_PROXY/HTTPS_PROXY)
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'Credentials': '/home/runner/.credentials'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'Runner': '/home/runner/.runner'
[2023-05-15 18:44:22Z INFO Listener] Runner is built for Linux (X64) - linux-x64.
[2023-05-15 18:44:22Z INFO Listener] RuntimeInformation: Linux 5.15.109+ #1 SMP Sat May 6 10:58:50 UTC 2023.
[2023-05-15 18:44:22Z INFO Listener] Version: 2.303.0
[2023-05-15 18:44:22Z INFO Listener] Commit: e676c7871817c1b484299cd93fabdf4b95e70741
[2023-05-15 18:44:22Z INFO Listener] Culture: 
[2023-05-15 18:44:22Z INFO Listener] UI Culture: 
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO Listener] Validating directory permissions for: '/home/runner'
[2023-05-15 18:44:22Z INFO CommandLineParser] Parse
[2023-05-15 18:44:22Z INFO CommandLineParser] Parsing 11 args
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: False
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding Command: configure
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: url
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding option 'url': 'https://github.com/FeedMapping'
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: token
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding option 'token': '***'
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: name
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding option 'name': 'Google-optimized-instance'
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: work
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding option 'work': '_work'
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: replace
[2023-05-15 18:44:22Z INFO CommandLineParser] parsing argument
[2023-05-15 18:44:22Z INFO CommandLineParser] HasArgs: True
[2023-05-15 18:44:22Z INFO CommandLineParser] arg: unattended
[2023-05-15 18:44:22Z INFO CommandLineParser] Adding flag: replace
[2023-05-15 18:44:22Z INFO Listener] Arguments parsed
[2023-05-15 18:44:22Z INFO Runner] ExecuteCommand
[2023-05-15 18:44:22Z INFO ConfigurationStore] currentAssemblyLocation: /home/runner/bin/Runner.Listener.dll
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO ConfigurationStore] binPath: /home/runner/bin
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO ConfigurationStore] RootFolder: /home/runner
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'Runner': '/home/runner/.runner'
[2023-05-15 18:44:22Z INFO ConfigurationStore] ConfigFilePath: /home/runner/.runner
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'Credentials': '/home/runner/.credentials'
[2023-05-15 18:44:22Z INFO ConfigurationStore] CredFilePath: /home/runner/.credentials
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'MigratedCredentials': '/home/runner/.credentials_migrated'
[2023-05-15 18:44:22Z INFO ConfigurationStore] MigratedCredFilePath: /home/runner/.credentials_migrated
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:22Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:22Z INFO HostContext] Well known config file 'Service': '/home/runner/.service'
[2023-05-15 18:44:22Z INFO ConfigurationStore] ServiceConfigFilePath: /home/runner/.service
[2023-05-15 18:44:22Z INFO CommandSettings] Flag 'help': 'False'
[2023-05-15 18:44:22Z INFO CommandSettings] Flag 'version': 'False'
[2023-05-15 18:44:22Z INFO CommandSettings] Flag 'commit': 'False'
[2023-05-15 18:44:22Z INFO CommandSettings] Flag 'check': 'False'
[2023-05-15 18:44:22Z INFO CommandSettings] Command 'configure': 'True'
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: --------------------------------------------------------------------------------
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |        ____ _ _   _   _       _          _        _   _                      |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |       / ___(_) |_| | | |_   _| |__      / \   ___| |_(_) ___  _ __  ___      |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |      | |  _| | __| |_| | | | | '_ \    / _ \ / __| __| |/ _ \| '_ \/ __|     |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |      | |_| | | |_|  _  | |_| | |_) |  / ___ \ (__| |_| | (_) | | | \__ \     |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |       \____|_|\__|_| |_|\__,_|_.__/  /_/   \_\___|\__|_|\___/|_| |_|___/     |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |                                                                              |
[2023-05-15 18:44:22Z INFO Terminal] WRITE: |                       
[2023-05-15 18:44:22Z INFO Terminal] WRITE: Self-hosted runner registration
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE:                         |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: |                                                                              |
[2023-05-15 18:44:22Z INFO Terminal] WRITE LINE: --------------------------------------------------------------------------------
[2023-05-15 18:44:22Z INFO ConfigurationManager] ConfigureAsync
[2023-05-15 18:44:22Z INFO CommandSettings] Flag 'generateServiceConfig': 'False'
[2023-05-15 18:44:22Z INFO ConfigurationStore] IsConfigured()
[2023-05-15 18:44:22Z INFO ConfigurationStore] IsConfigured: False
[2023-05-15 18:44:22Z INFO ConfigurationManager] Is configured: False
[2023-05-15 18:44:22Z INFO CommandSettings] Arg 'url': 'https://github.com/FeedMapping'
[2023-05-15 18:44:22Z INFO CommandSettings] Remove url from Arg dictionary.
[2023-05-15 18:44:22Z INFO CommandSettings] Arg 'token': '***'
[2023-05-15 18:44:22Z INFO CommandSettings] Remove token from Arg dictionary.
[2023-05-15 18:44:24Z INFO ConfigurationManager] Http response code: OK from 'POST https://api.github.com/actions/runner-registration' (E774:461B:1E7DC8F:3E4A2E3:64627D87)
[2023-05-15 18:44:24Z INFO ConfigurationManager] cred retrieved via GitHub auth
[2023-05-15 18:44:24Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:24Z INFO RunnerServer] Establish connection with 100 seconds timeout.
[2023-05-15 18:44:24Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:24Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:24Z INFO RunnerServer] Establish connection with 60 seconds timeout.
[2023-05-15 18:44:24Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:24Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:24Z INFO RunnerServer] Establish connection with 60 seconds timeout.
[2023-05-15 18:44:24Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:24Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:24Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:24Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:25Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:25Z INFO ConfigurationManager] Test Connection complete.
[2023-05-15 18:44:25Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:25Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:25Z INFO HostContext] Well known config file 'RSACredentials': '/home/runner/.credentials_rsaparams'
[2023-05-15 18:44:25Z INFO RSAFileKeyManager] Creating new RSA key using 2048-bit key length
[2023-05-15 18:44:25Z INFO RSAFileKeyManager] Successfully saved RSA key parameters to file /home/runner/.credentials_rsaparams
[2023-05-15 18:44:25Z INFO RSAFileKeyManager] Which: 'chmod'
[2023-05-15 18:44:25Z INFO RSAFileKeyManager] Location: '/bin/chmod'
[2023-05-15 18:44:26Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:26Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] Starting process:
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   File name: '/bin/chmod'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Arguments: '600 /home/runner/.credentials_rsaparams'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Working directory: '/home/runner'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Require exit code zero: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Encoding web name:  ; code page: ''
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Force kill process on cancellation: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Redirected STDIN: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Persist current code page: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   Keep redirected STDIN open: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper]   High priority process: 'False'
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] Updated oom_score_adj to 500 for PID: 75.
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] Process started with process id 75, waiting for process exit.
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] STDOUT/STDERR stream read finished.
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] STDOUT/STDERR stream read finished.
[2023-05-15 18:44:26Z INFO ProcessInvokerWrapper] Finished process 75 with exit code 0, and elapsed time 00:00:00.2254015.
[2023-05-15 18:44:26Z INFO RSAFileKeyManager] Successfully set permissions for RSA key parameters file /home/runner/.credentials_rsaparams
[2023-05-15 18:44:26Z INFO CommandSettings] Arg 'runnergroup': ''
[2023-05-15 18:44:26Z INFO CommandSettings] Flag 'unattended': 'True'
[2023-05-15 18:44:26Z INFO PromptManager] ReadValue
[2023-05-15 18:44:26Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:26Z INFO ConfigurationManager] Found a self-hosted runner group with id 1 and name Default
[2023-05-15 18:44:26Z INFO CommandSettings] Flag 'disableupdate': 'False'
[2023-05-15 18:44:26Z INFO CommandSettings] Flag 'ephemeral': 'False'
[2023-05-15 18:44:26Z INFO CommandSettings] Arg 'name': 'Google-optimized-instance'
[2023-05-15 18:44:26Z INFO CommandSettings] Remove name from Arg dictionary.
[2023-05-15 18:44:26Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:26Z INFO CommandSettings] Arg 'labels': ''
[2023-05-15 18:44:26Z INFO CommandSettings] Flag 'unattended': 'True'
[2023-05-15 18:44:26Z INFO PromptManager] ReadValue
[2023-05-15 18:44:26Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:27Z INFO Terminal] WRITE LINE: A runner exists with the same name
[2023-05-15 18:44:27Z INFO CommandSettings] Flag 'replace': 'True'
[2023-05-15 18:44:27Z INFO CommandSettings] Flag 'disableupdate': 'False'
[2023-05-15 18:44:27Z INFO CommandSettings] Flag 'disableupdate': 'False'
[2023-05-15 18:44:27Z INFO CommandSettings] Flag 'ephemeral': 'False'
[2023-05-15 18:44:27Z INFO ConfigurationStore] Saving OAuth credential @ /home/runner/.credentials
[2023-05-15 18:44:27Z INFO ConfigurationStore] Credentials Saved.
[2023-05-15 18:44:27Z INFO ConfigurationStore] HasCredentials()
[2023-05-15 18:44:27Z INFO ConfigurationStore] stored True
[2023-05-15 18:44:27Z INFO CredentialManager] GetCredentialProvider
[2023-05-15 18:44:27Z INFO CredentialManager] Creating type OAuth
[2023-05-15 18:44:27Z INFO CredentialManager] Creating credential type: OAuth
[2023-05-15 18:44:27Z INFO RSAFileKeyManager] Loading RSA key parameters from file /home/runner/.credentials_rsaparams
[2023-05-15 18:44:27Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:27Z INFO RunnerServer] Establish connection with 100 seconds timeout.
[2023-05-15 18:44:27Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:27Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:27Z INFO RunnerServer] Establish connection with 60 seconds timeout.
[2023-05-15 18:44:27Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:27Z INFO RunnerServer] EstablishVssConnection
[2023-05-15 18:44:27Z INFO RunnerServer] Establish connection with 60 seconds timeout.
[2023-05-15 18:44:28Z INFO GitHubActionsService] Starting operation Location.GetConnectionData
[2023-05-15 18:44:28Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:28Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:28Z INFO GitHubActionsService] Finished operation Location.GetConnectionData
[2023-05-15 18:44:28Z INFO RSAFileKeyManager] Loading RSA key parameters from file /home/runner/.credentials_rsaparams
[2023-05-15 18:44:28Z INFO RSAFileKeyManager] Loading RSA key parameters from file /home/runner/.credentials_rsaparams
[2023-05-15 18:44:29Z INFO GitHubActionsService] AAD Correlation ID for this token request: Unknown
[2023-05-15 18:44:29Z INFO CommandSettings] Arg 'work': '_work'
[2023-05-15 18:44:29Z INFO CommandSettings] Remove work from Arg dictionary.
[2023-05-15 18:44:29Z INFO ConfigurationStore] Saving runner settings.
[2023-05-15 18:44:29Z INFO ConfigurationStore] Settings Saved.
[2023-05-15 18:44:29Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:29Z INFO Terminal] WRITE LINE: 
[2023-05-15 18:44:29Z INFO SystemDControlManager] Service name 'actions.runner.FeedMapping.Google-optimized-instance.service' display name 'GitHub Actions Runner (FeedMapping.Google-optimized-instance)' will be used for service configuration.
[2023-05-15 18:44:29Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:29Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:29Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:29Z INFO HostContext] Well known directory 'Bin': '/home/runner/bin'
[2023-05-15 18:44:29Z INFO HostContext] Well known directory 'Root': '/home/runner'
[2023-05-15 18:44:29Z INFO UnixUtil] Which: 'chmod'
[2023-05-15 18:44:29Z INFO UnixUtil] Location: '/bin/chmod'
[2023-05-15 18:44:29Z INFO UnixUtil] Running /bin/chmod 755 "/home/runner/svc.sh"
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] Starting process:
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   File name: '/bin/chmod'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Arguments: '755 "/home/runner/svc.sh"'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Working directory: '/home/runner'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Require exit code zero: 'True'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Encoding web name:  ; code page: ''
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Force kill process on cancellation: 'False'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Redirected STDIN: 'False'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Persist current code page: 'False'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   Keep redirected STDIN open: 'False'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper]   High priority process: 'False'
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] Updated oom_score_adj to 500 for PID: 79.
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] Process started with process id 79, waiting for process exit.
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] STDOUT/STDERR stream read finished.
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] STDOUT/STDERR stream read finished.
[2023-05-15 18:44:29Z INFO ProcessInvokerWrapper] Finished process 79 with exit code 0, and elapsed time 00:00:00.0022358.
[2023-05-15 18:44:29Z INFO Listener] Runner execution has finished with return code 0
```

### System File

There is a powerful command in Linux that helps you search for files and folders called find. In this article, we will discuss the find command with some examples.

```
$ find / -type f -name "Dockerfile*"

/mnt/disks/Linux/opt/src/github.com/google/inverting-proxy/agent/Dockerfile
/mnt/disks/Linux/opt/deeplearning/inverting-proxy-master/agent/Dockerfile
/mnt/disks/Linux/opt/deeplearning/src/models/research/object_detection/dockerfiles/android/Dockerfile
/mnt/disks/Linux/opt/deeplearning/src/models/research/object_detection/dockerfiles/tf2_ai_platform/Dockerfile
/mnt/disks/Linux/opt/deeplearning/src/models/research/object_detection/dockerfiles/tf1/Dockerfile
/mnt/disks/Linux/opt/deeplearning/src/models/research/object_detection/dockerfiles/tf2/Dockerfile
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/pipelines/containers/deploycmle/Dockerfile
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/pipelines/containers/bqtocsv/Dockerfile
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/pipelines/containers/hypertrain/Dockerfile
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/pipelines/containers/deployapp/Dockerfile
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/pipelines/containers/traintuned/Dockerfile

/mnt/disks/Linux/usr/share/models/research/object_detection/dockerfiles/android/Dockerfile
/mnt/disks/Linux/usr/share/models/research/object_detection/dockerfiles/tf2_ai_platform/Dockerfile
/mnt/disks/Linux/usr/share/models/research/object_detection/dockerfiles/tf1/Dockerfile
/mnt/disks/Linux/usr/share/models/research/object_detection/dockerfiles/tf2/Dockerfile
/mnt/disks/Linux/usr/share/man/man5/Dockerfile.5.gz

/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/python/data/Dockerfile.install_app
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/python/data/Dockerfile.virtualenv.template
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/python/data/Dockerfile.requirements_txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/python/data/Dockerfile.preamble
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/ruby/templates/Dockerfile.template
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/php/templates/Dockerfile.template
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/php/templates/Dockerfile.entrypoint.template
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/go/data/Dockerfile
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/nodejs/data/Dockerfile
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/google-auth-library-python/.kokoro/docker/docs/Dockerfile
/mnt/disks/Linux/usr/local/go/src/crypto/elliptic/internal/fiat/Dockerfile

/mnt/stateful_partition/var/lib/docker/overlay2/l5js8cyp55dvi6cah1i3gzu4k/diff/Dockerfile
/mnt/stateful_partition/var/lib/docker/overlay2/6af1c7208063f51f2dc03dbc263eae3f4e148d6bcfd1608bfa4231ca764c5658/diff/home/runner/_work/Partition/Partition/.github/actions/intro/Dockerfile
```

Now let's say we want to find files with a particular extension like .txt. We'll modify the command like this:

```
/mnt/disks/Linux/opt/conda/pkgs/grpc-cpp-1.48.1-hc2bec63_1/info/test/examples/python/xds/requirements.txt
/mnt/disks/Linux/opt/deeplearning/src/models/official/requirements.txt
/mnt/disks/Linux/opt/deeplearning/src/models/official/projects/unified_detector/requirements.txt
/mnt/disks/Linux/opt/deeplearning/src/models/official/projects/movinet/requirements.txt
/mnt/disks/Linux/opt/deeplearning/src/models/research/deep_speech/requirements.txt
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/tf2_course/requirements.txt
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/serving/application/requirements.txt
/mnt/disks/Linux/opt/deeplearning/workspace/tutorials/machine_learning_deepdive/06_structured/labs/serving/application/requirements.txt

/mnt/disks/Linux/usr/share/models/official/requirements.txt
/mnt/disks/Linux/usr/share/models/official/projects/unified_detector/requirements.txt
/mnt/disks/Linux/usr/share/models/official/projects/movinet/requirements.txt
/mnt/disks/Linux/usr/share/models/research/deep_speech/requirements.txt

/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/ext-runtime/java/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/gslib/vendored/boto/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/gslib/vendored/oauth2client/docs/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/httplib2/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/requests/docs/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/pyasn1/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/pyasn1-modules/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/charset_normalizer/docs/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/gcs-oauth2-boto-plugin/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/urllib3/docs/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/google-auth-library-python/.kokoro/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/google-auth-library-python/testing/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/google-auth-library-python/samples/cloud-client/snippets/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/google-auth-library-python/system_tests/system_tests_sync/app_engine_test_app/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil/third_party/mock/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/gslib/vendored/boto/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/gslib/vendored/oauth2client/docs/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/third_party/pyasn1/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/third_party/pyasn1-modules/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/third_party/gcs-oauth2-boto-plugin/requirements.txt
/mnt/disks/Linux/usr/lib/google-cloud-sdk/platform/gsutil_py2/third_party/mock/requirements.txt

/mnt/disks/Linux/usr/samples/python/network_api_pytorch_mnist/requirements.txt
/mnt/disks/Linux/usr/samples/python/requirements.txt
/mnt/disks/Linux/usr/samples/python/engine_refit_onnx_bidaf/requirements.txt
/mnt/disks/Linux/usr/samples/python/introductory_parser_samples/requirements.txt
/mnt/disks/Linux/usr/samples/python/end_to_end_tensorflow_mnist/requirements.txt
/mnt/disks/Linux/usr/samples/python/int8_caffe_mnist/requirements.txt
/mnt/disks/Linux/usr/samples/python/engine_refit_mnist/requirements.txt
/mnt/disks/Linux/usr/samples/python/uff_ssd/requirements.txt
/mnt/disks/Linux/usr/samples/python/uff_custom_plugin/requirements.txt
/mnt/disks/Linux/usr/samples/python/yolov3_onnx/requirements.txt
/mnt/disks/Linux/usr/samples/python/onnx_packnet/requirements.txt
/mnt/disks/Linux/usr/samples/sampleUffMaskRCNN/converted/requirements.txt
/mnt/disks/Linux/usr/samples/sampleSSD/requirements.txt

/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/network_api_pytorch_mnist/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/engine_refit_onnx_bidaf/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/introductory_parser_samples/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/end_to_end_tensorflow_mnist/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/int8_caffe_mnist/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/engine_refit_mnist/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/uff_ssd/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/uff_custom_plugin/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/yolov3_onnx/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/python/onnx_packnet/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/sampleUffMaskRCNN/converted/requirements.txt
/mnt/disks/Linux/usr/targets/x86_64-linux-gnu/samples/sampleSSD/requirements.txt
```

The find command lets you efficiently search for files, folders, and character and block devices. Below is the basic syntax of the find command:

```
$ find / -type d -name "tensorflow*"

/mnt/disks/Linux/opt/deeplearning/binaries/tensorflow
/mnt/disks/Linux/opt/deeplearning/src/models/tensorflow_models
/mnt/disks/Linux/usr/share/models/tensorflow_models

/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_cloud-0.1.16.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorboard/compat/tensorflow_stub
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_probability
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_io_gcs_filesystem-0.29.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_io
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/google/cloud/aiplatform/training_utils/cloud_profiler/plugins/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_io_gcs_filesystem
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_datasets
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_estimator
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorboard_plugin_wit/_vendor/tensorflow_serving
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_cloud
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow/xla_aot_runtime_src/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow/compiler/mlir/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow/include/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow/include/tensorflow/compiler/mlir/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_io-0.29.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_probability-0.19.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/ray/train/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/witwidget/_vendor/tensorflow_serving
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_serving_api-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_hub-0.13.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_estimator-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_transform-1.12.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/pyarrow/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/pyarrow/include/arrow/adapters/tensorflow
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_metadata
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_serving
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_hub
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_transform
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_metadata-1.12.0.dist-info
/mnt/disks/Linux/opt/conda/lib/python3.7/site-packages/tensorflow_datasets-4.8.2.dist-info

/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_cloud-0.1.16.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorboard/compat/tensorflow_stub
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_probability
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_io_gcs_filesystem-0.29.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_io
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/google/cloud/aiplatform/training_utils/cloud_profiler/plugins/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_io_gcs_filesystem
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_datasets
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_estimator
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorboard_plugin_wit/_vendor/tensorflow_serving
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_cloud
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow/xla_aot_runtime_src/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow/compiler/mlir/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow/include/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow/include/tensorflow/compiler/mlir/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_io-0.29.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_probability-0.19.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/ray/train/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/witwidget/_vendor/tensorflow_serving
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_serving_api-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_hub-0.13.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_estimator-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_transform-1.12.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/pyarrow/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/pyarrow/include/arrow/adapters/tensorflow
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow-2.11.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_metadata
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_serving
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_hub
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_transform
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_metadata-1.12.0.dist-info
/mnt/disks/Linux/opt/conda/pkgs/dlenv-tf-2-11-gpu-1.0.20230429-py37hfd508a8_0/lib/python3.7/site-packages/tensorflow_datasets-4.8.2.dist-info
```

![default](https://user-images.githubusercontent.com/8466209/199132181-38a98bf9-9d72-4740-b96c-c57da26a6135.png)

[![default](https://user-images.githubusercontent.com/8466209/198812060-bcf0c3e5-1918-4245-b2fa-1c43c2602a90.png)](https://www.chetabahana.com/)

[![default](https://user-images.githubusercontent.com/8466209/227684922-9b3190e2-879c-42e5-b404-fb975b9b8752.png)](https://cloud.google.com/sdk/gcloud/reference/compute/instances/create#--metadata)
