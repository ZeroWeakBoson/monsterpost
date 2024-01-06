
This [solution](https://stackoverflow.com/a/42673938/4058484) is primary based on modules importlib and pkgutil and work with CPython 3.4 and CPython 3.5, but has no support for the CPython 2.

python_modules_info.py
```
import sys
import os
import shutil
import pkgutil
import importlib
import collections

if sys.version_info.major == 2:
    raise NotImplementedError('CPython 2 is not supported yet')


def main():

    # name this file (module)
    this_module_name = os.path.basename(__file__).rsplit('.')[0]

    # dict for loaders with their modules
    loaders = collections.OrderedDict()

    # names`s of build-in modules
    for module_name in sys.builtin_module_names:

        # find an information about a module by name
        module = importlib.util.find_spec(module_name)

        # add a key about a loader in the dict, if not exists yet
        if module.loader not in loaders:
            loaders[module.loader] = []

        # add a name and a location about imported module in the dict
        loaders[module.loader].append((module.name, module.origin))

    # all available non-build-in modules
    for module_name in pkgutil.iter_modules():

        # ignore this module
        if this_module_name == module_name[1]:
            continue

        # find an information about a module by name
        module = importlib.util.find_spec(module_name[1])

        # add a key about a loader in the dict, if not exists yet
        loader = type(module.loader)
        if loader not in loaders:
            loaders[loader] = []

        # add a name and a location about imported module in the dict
        loaders[loader].append((module.name, module.origin))

    # pretty print
    line = '-' * shutil.get_terminal_size().columns
    for loader, modules in loaders.items():
        print('{0}\n{1}: {2}\n{0}'.format(line, len(modules), loader))
        for module in modules:
            print('{0:30} | {1}'.format(module[0], module[1]))


if __name__ == '__main__':
    main()
```

[![default](https://user-images.githubusercontent.com/8466209/199131193-34b17216-1308-4efc-953c-708e31007505.png)](https://gist.github.com/eq19/8cab5e72d52ecb338a2f2187082a1699#file-4_quantum-md)

[![default](https://user-images.githubusercontent.com/8466209/198928812-cab7aef3-9c41-49f4-8b89-00b8fa3fc95a.png)](https://gist.github.com/eq19/88d09204b2e5986237bd66d062406fde#file-lexer-md)

[![default](https://user-images.githubusercontent.com/8466209/199133270-71ca3596-983b-435a-82f6-bcaa682ae650.png)](https://github.com/FeedMapping/prime-hexagon)

A better understanding of the distribution of prime numbers would be a major breakthrough in mathematics A continued relationship with the powers of pi could indicate a connection to circular geometry Other patterns can be analyzed to determine if they are related to the distribution of primes The speed and scalability of the cluster allows Tad Gallion and other researchers to check values of numbers that are significantly higher than any individual computer could compute in a reasonable time constraint The parallelization of the algorithm achieved a 9X speedup *****using CUDA GPU programming***** Because the cluster is managed over the internet, new compute nodes can be added with minimal effort Visualization tools enable researchers to explore the prime hexagon quickly and discover patterns that can be further analyzed Understanding the pattern of prime numbers could have effects in cryptography Many modern encryption algorithms depend on the factorization of very large primes which are hard to find