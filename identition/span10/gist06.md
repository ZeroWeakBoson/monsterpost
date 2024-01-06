# Site GitHub

The following sample information is exposed to Jekyll templates in the [site.github](https://github.com/jekyll/github-metadata/blob/main/docs/site.github.md#using-sitegithub) namespace:

```
{% raw %}
{% for item in site.github %}
  * {{ item | jsonify }}: {{ site.github[item] | jsonify }}
{% endfor %}
{% endraw %}
```

Output:
```
{
    "versions": {
        "jekyll": <version>,
        "kramdown": <version>,
        "liquid": <version>,
        "maruku": <version>,
        "rdiscount": <version>,
        "redcarpet": <version>,
        "RedCloth": <version>,
        "jemoji": <version>,
        "jekyll-mentions": <version>,
        "jekyll-redirect-from": <version>,
        "jekyll-sitemap": <version>,
        "github-pages": <version>,
        "ruby": <version>"
    },
    "hostname": "github.com",
    "pages_hostname": "github.io",
    "api_url": "https://api.github.com",
    "help_url": "https://help.github.com",
    "environment": "dotcom",
    "pages_env": "dotcom",
    "public_repositories": [ Repository Objects ],
    "organization_members": [ User Objects ],
    "build_revision": "cbd866ebf142088896cbe71422b949de7f864bce",
    "project_title": "metadata-example",
    "project_tagline": "A GitHub Pages site to showcase repository metadata",
    "owner_name": "github",
    "owner_url": "https://github.com/github",
    "owner_gravatar_url": "https://github.com/github.png",
    "repository_url": "https://github.com/github/metadata-example",
    "repository_nwo": "github/metadata-example",
    "repository_name": "metadata-example",
    "zip_url": "https://github.com/github/metadata-example/zipball/gh-pages",
    "tar_url": "https://github.com/github/metadata-example/tarball/gh-pages",
    "clone_url": "https://github.com/github/metadata-example.git",
    "releases_url": "https://github.com/github/metadata-example/releases",
    "issues_url": "https://github.com/github/metadata-example/issues",
    "wiki_url": "https://github.com/github/metadata-example/wiki",
    "language": null,
    "is_user_page": false,
    "is_project_page": true,
    "show_downloads": true,
    "url": "http://username.github.io/metadata-example", // (or the CNAME)
    "baseurl": "/metadata-example",
    "contributors": [ User Objects ],
    "releases": [ Release Objects ],
    "latest_release": [ Release Object ],
    "private": false,
    "archived": false,
    "disabled": false,
    "license": {
      "key": "mit",
      "name": "MIT License",
      "spdx_id": "MIT",
      "url": "https://api.github.com/licenses/mit"
    },
    "source": {
      "branch": "gh-pages",
      "path": "/"
    }
}
```

## GitHub API

Jekyll supports [loading data](https://jekyllrb.com/docs/datafiles/) from YAML, JSON, CSV, and TSV files located in the _data directory. Note that CSV and TSV files must contain a header row.

```bash
    gh api -H "${HEADER}" /user/orgs  --jq '.[].login' | sort -uf | yq eval -P | sed "s/ /, /g" > /tmp/user_orgs
    IFS=', '; array=($(cat /tmp/user_orgs))

    echo "[" > _data/orgs.json
    for ((i=0; i < ${#array[@]}; i++)); do
	  gh api -H "${HEADER}" /orgs/${array[$i]} >> _data/orgs.json
      if [[ "$i" -lt "${#array[@]}-1" ]]; then echo "," >> _data/orgs.json; fi
    done
    echo "]" >> _data/orgs.json
  fi
```

```liquid
{% raw %}
{% for item in site.data.orgs %}
  - {{ item.name | jsonify }}
{% endfor %}
{% endraw %}
```

{%- for item in site.data.orgs -%}
  - {{ item.name | jsonify }}
{%- endfor -%}

## Wotkflow Run

[![default](https://user-images.githubusercontent.com/8466209/201278178-6c8eb4c9-1a45-4583-b61e-b948d9431e95.png)](https://github.com/TheAlgorithms/Python/blob/master/.github/workflows/build.yml)

[![default](https://user-images.githubusercontent.com/8466209/201258756-7f1cc4e4-fc24-4061-8dbe-8610dd56a557.png)](https://gist.github.com/eq19/b541275ab7deda356feef32d600e44d8#file-gitignore-md)

[![default](https://user-images.githubusercontent.com/8466209/201274327-f0e777ad-7226-4b86-bb1e-c21290264492.png)](https://gist.github.com/eq19/6c89c3b0f109e0ead561a452720d1ebf#file-runner-md)

