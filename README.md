# gatherpress-devhub

>I’d like to see (and maybe start working on) a blueprint that replicates the WordPress devhub for a custom plugin. As a real use-case I’d like to explore creating developer.gatherpress.org with the phpdoc-parser running against the plugin code of GatherPress.

- [New developer.gatherpress.org · Issue #1 · carstingaxion/gatherpress-devhub](https://github.com/carstingaxion/gatherpress-devhub/issues/1)
- [WordPress devhub blueprint · Issue #44 · WordPress/blueprints](https://github.com/WordPress/blueprints/issues/44)

[<kbd> <br> pre-built GatherPress devhub <br> </kbd>](https://playground.wordpress.net/?mode=seamless&blueprint-url=https://raw.githubusercontent.com/carstingaxion/gatherpress-devhub/WIP/use-build-deps/blueprint-import.json)

[<kbd> <br> GatherPress devhub <br> </kbd>](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/carstingaxion/gatherpress-devhub/WIP/use-build-deps/blueprint.json)

[<kbd> <br> Edit <code>blueprint.json</code> <br> </kbd>](https://playground.wordpress.net/builder/builder.html?blueprint-url=https://raw.githubusercontent.com/carstingaxion/gatherpress-devhub/WIP/use-build-deps/blueprint.json)

---

## Learnings

1. Needs to run php 7.4
2. Activate Posts-to-Posts after phpdoc-parser, because of clashing dependencies
3. Running the parser in this order results in destroyed `<sourcecode>`. 
    ```
    {
      "step": "wp-cli",
      "command": "wp parser create '/wordpress/wp-content/plugins/gatherpress' --user=1"
    },
    {
      "step": "wp-cli",
      "command": "wp parser create '/wordpress/wp-content/plugins/gatherpress-alpha-main' --user=1"
    },
    ```
    Running it in the opposite order, *only* destroys the source for the alpha-main plugin.