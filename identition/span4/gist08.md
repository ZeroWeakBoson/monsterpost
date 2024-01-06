```
FROM tensorflow/tensorflow:latest-gpu

LABEL version="1.0.7"
LABEL homepage="https://eq19.github.io/"
LABEL maintainer="eq19 <admin@rq19.com>"
LABEL repository="https://github.com/FeedMapping/deploy"

ENV DEBIAN_FRONTEND noninteractive
ENV DEBCONF_NOWARNINGS="yes"

RUN apt-get update -qq < /dev/null
RUN apt-get install -qq --no-install-recommends apt-utils < /dev/null

ENV NVIDIA_VISIBLE_DEVICES all
ENV NVIDIA_DRIVER_CAPABILITIES compute,utility
ENV PATH="${PATH}:/root/.local/bin"

RUN apt-get install -qq python3.8-venv < /dev/null
RUN python3.8 -m venv nvidia < /dev/null
RUN chown -R root nvidia && source nvidia/bin/activate
RUN python -m pip install -U --force-reinstall pip < /dev/null
RUN pip install tensorflow-gpu --root-user-action=ignore --quiet

ENV NOKOGIRI_USE_SYSTEM_LIBRARIES=1
ENV BUNDLE_SILENCE_ROOT_WARNING=1
ENV RAILS_VERSION 5.0.1
ENV RUBYOPT=W0

RUN apt-get install -qq npm < /dev/null && npm install -qq yarn < /dev/null
RUN apt-get install -qq ruby ruby-dev ruby-bundler build-essential < /dev/null
RUN apt-get install -qq git < /dev/null && git config --global init.defaultBranch master

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* < /dev/null
RUN gem install rails --version "$RAILS_VERSION" < /dev/null

COPY . .
ENTRYPOINT ["/entrypoint.sh"]

```

[![image](https://user-images.githubusercontent.com/8466209/198936863-10e3e037-6665-49c3-b147-3accda4d133b.png)](https://hub.docker.com/r/tensorflow/tensorflow)

[![default](https://user-images.githubusercontent.com/8466209/199148983-8c6e4c62-8503-4412-9a48-1b8cb54b7a94.png)](https://github.com/FeedMapping/mapping/releases/tag/v1.0.7)

[![default](https://user-images.githubusercontent.com/8466209/198936548-967ca221-41b7-461b-9b4b-9ff30eedea50.png)](https://github.com/eq19/grammar/actions/runs/3357023441/jobs/5562550171)

[![default](https://user-images.githubusercontent.com/8466209/225285187-916bee67-a633-4917-84da-7a3187caeb03.png)](https://console.cloud.google.com/billing/018F05-BD9DB7-0A1326/reports;grouping=GROUP_BY_SKU;products=services%2F6F81-5844-456A;credits=CREDIT_TYPE_UNSPECIFIED,PROMOTION,SUSTAINED_USAGE_DISCOUNT,SPENDING_BASED_DISCOUNT?authuser=1&cloudshell=false)

