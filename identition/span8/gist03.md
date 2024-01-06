```
FROM tensorflow/tensorflow:latest-gpu

LABEL version=v1.0.9

ENV DEBCONF_NOWARNINGS="yes"
ARG DEBIAN_FRONTEND=noninteractive

ENV NVIDIA_VISIBLE_DEVICES all
ENV NVIDIA_DRIVER_CAPABILITIES compute,utility

RUN apt-get update &>/dev/null
RUN apt-get install python3.8-venv &>/dev/null
RUN /usr/bin/python3.8 -m venv /maps &>/dev/null

ADD . /maps
ENTRYPOINT ["/maps/entrypoint.sh"]

```

[![default](https://user-images.githubusercontent.com/8466209/200241238-23d238be-9006-4ac8-b9e8-1daa48ab8d8f.png)](https://gist.github.com/eq19/f1af4317b619154719546e615aaa2155#file-6_pattern-md)

[![default](https://user-images.githubusercontent.com/8466209/200240844-1e76f817-775a-4cc1-9998-20e71efcc4ee.png)](https://github.com/eq19/grammar/actions/runs/3405771627/jobs/5663983028)

