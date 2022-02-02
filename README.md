# How to create a Moodle block plugin

## Step 1 : install the plugin

Choose a name for your plugin and create a directory named the same way.

1. Create a folder named `tutorial_block` in the `blocks` directory.
2. Create a `version.php` file within the `tutorial_block` directory :

```php
// version.php
defined('MOODLE_INTERNAL') || die();

$plugin->version    = 2022020200;
$plugin->requires   = 2016052300;
$plugin->release    = '1.0.0';
$plugin->component  = 'block_tutorial_block';
$plugin->maturity   = MATURITY_STABLE;
```

*Note that your plugin component name is : `block_tutorial_block`*

3. Create the block class file `block_tutorial_block.php` :

```php
// block_tutorial_block.php
defined('MOODLE_INTERNAL') || die();

class block_tutorial_block extends block_base {
    public function init() {
        $this->blockname = get_class($this);
        $this->title = get_string('pluginname', 'block_tutorial_block');
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function has_config() {
        return true;
    }

    public function instance_allow_config() {
        return true;
    }

    public function get_content() {
        $this->content = new stdClass();
        $this->content->text = "hello";
        return $this->content;
    }

    public function applicable_formats() {
        return array('all' => true);
    }
}
```

4. Visit Moodle base URL and it should proceed to the installation of your plugin.

*Note that it doesn't register a correct plugin name and uses instead : `[pluginname,block_tutorial_block]`*

#### Structure at step 1 :

```yaml
moodle-root:
    blocks:
        tutorial_block:
            block_tutorial_block.php
            version.php
```


## Step 2 : fix the plugin strings

1. Create a `lang/en` directory within the block's folder :

```php
// lang/en/block_tutorial_block.php
$string['pluginname'] = 'Tutorial block';
```

2. Upgrade the plugin version number by increasing its last digit by one :

```php
// version.php
$plugin->version    = 2022020201;
// ...
```

This will trigger an update when visiting Moodle's root URL.
After the update, your plugin will be named correctly 

#### Structure at step 2 :

```yaml
moodle-root:
    blocks:
        tutorial_block:
            lang:
                en:
                    block_tutorial_block.php
            block_tutorial_block.php
            version.php
```

## Step 3 : fix the capabilities issues

If you try to add the block in a course, Moodle will output an error : 
*The block tutorial_block does not define the standard capability block/tutorial_block:addinstance*

We need to address the issue.

1. Create a `db` directory in the block folder
2. Create a file named `access.php` within this folder :

```php
// db/access.php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'block/tutorial_block:addinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    )
);
```

3. Once again, increasing the plugin version to trigger the update :

```php
// version.php
$plugin->version    = 2022020202;
// ...
```

4. Visit Moodle's root URL to update the plugin

#### Structure at step 3 :

```yaml
moodle-root:
    blocks:
        tutorial_block:
            db:
                access.php
            lang:
                en:
                    block_tutorial_block.php
            block_tutorial_block.php
            version.php
```

## Step 4 : add CSS

1. Create a file named `styles.css` at the root of your plugin directory.
2. Add some styling :

```css
.block_tutorial_block .content {
    font-weight: bold;
    color: blulone;
}
```

3. Contemplate