# Leuchtfeuer Mautic Distribution

This project uses `mautic/core-composer-scaffold` feature to overwrite Mautic core files on project setups using Composer.
The the [docs](https://github.com/mautic/core-composer-scaffold) how to use it.

An important file is the `.gitignore`, which is customized especially for this Leuchtfeuer setup. It excludes all files,
folders and packages coming from Mautic core.
```json
"extra": {
    "mautic-scaffold": {
        "file-mapping": {
            "[project-root]/.gitignore": "scaffold/files/project.gitignore"
        }
    }
}
```