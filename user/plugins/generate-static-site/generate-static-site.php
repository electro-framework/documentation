<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Common\Page\Page;
use Grav\Common\Page\Types;
use Grav\Common\Taxonomy;
use Grav\Common\Utils;
use Grav\Common\Data\Data;
use RocketTheme\Toolbox\Event\Event;

use Bit3\GitPhp\GitRepository;

/**
 * Class GenerateStaticSitePlugin
 * @package Grav\Plugin
 */
class GenerateStaticSitePlugin extends Plugin
{

    protected $folder = "/Users/alex/Sites/docSami/staticOutput";
    protected $site = "http://localhost/~alex/docSami";
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onTwigTemplatePaths'  => ['onTwigTemplatePaths', 0],
        ];
    }

    /**
     * Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $uri = $this->grav['uri'];

        if ($this->config->get('plugins.generate-static-site.route_home') == $uri->path()) {
            $this->enable([
                'onPageInitialized' => ['onHomePage', 0]
            ]);
        }

        if ($this->config->get('plugins.generate-static-site.route_init') == $uri->path()) {
            $this->enable([
                'onPageInitialized' => ['generateStaticSite', 0]
            ]);
        }

    }

    public function generateStaticSite(){

        //limpar a pasta

        //generate static web site files to folder
        $command = '/usr/local/bin/wget --mirror --convert-links --html-extension  -P'.$this->folder.' '.$this->site.' 2>&1';

        exec($command, $output);

        if ($output == "") {
            $msg = "error fetch site";
        } else {

            //commit the files to github usando bash script
            $output = shell_exec($this->folder.'/commit.sh');
            echo "<pre>$output</pre>";
            $msg = "1";
            $timestamp = date('Y-m-d H:m:s');
            /*$commitGit = 'git add -A '.$this->folder.' && git commit -m "New automatic  commit: '.$timestamp.'" '.$this->folder.'';
            $pushGit = 'git push '.$this->folder.'';

            exec($commitGit, $outputCommitGit);

            var_dump($outputCommitGit);

            if ($outputCommitGit) {

                exec($pushGit, $outputPushGit);

                var_dump($outputPushGit);

                if ($outputPushGit) {
                    $msg = "success";
                } else {
                    $msg = "error push git";
                }

            } else {
                $msg = "error commit git";
            }*/



        }

        $this->grav['msg'] = $msg;


        $page = new Page;

        $page->init(new \SplFileInfo(__DIR__ . "/pages/init.md"));

        unset($this->grav['page']);

        $this->grav['page'] = $page;
    }

    public function onHomePage()
    {
        //$route = $this->config->get('plugins.generate-static-site.route');
        $page = new Page;

        $page->init(new \SplFileInfo(__DIR__ . "/pages/generate.md"));

        unset($this->grav['page']);


        $this->grav['page'] = $page;

    }

    /**
     * Do some work for this event, full details of events can be found
     * on the learn site: http://learn.getgrav.org/plugins/event-hooks
     *
     * @param Event $e
     */
    public function onPageContentRaw(Event $e)
    {
        echo('hey');
        // Get a variable from the plugin configuration
        $text = $this->grav['config']->get('plugins.generate-static-site.text_var');

        // Get the current raw content
        $content = $e['page']->getRawContent();

        // Prepend the output with the custom text and set back on the page
        $e['page']->setRawContent($text . "\n\n" . $content);
    }
}
