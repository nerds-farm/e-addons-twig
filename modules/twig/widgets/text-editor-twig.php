<?php

namespace EAddonsTwig\Modules\Twig\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use EAddonsForElementor\Base\Base_Widget;
use EAddonsForElementor\Core\Utils;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Elementor Twig
 *
 * Elementor widget for Dinamic Content Elements
 *
 */
class Text_Editor_Twig extends Base_Widget {

    public function get_name() {
        return 'e-text-editor-twig';
    }

    public function get_title() {
        return __('Text Editor with Twig', 'e-addons');
    }

    public function get_description() {
        return __('Add shortcode into the post text to show every value from Post, User e Option', 'e-addons');
    }

    public function get_categories() {
        return ['e-addons'];
    }

    public function get_pid() {
        return 7186;
    }

    public function get_icon() {
        return 'eadd-text-editor-twig';
    }

    /**
     * Enqueue admin styles
     *
     * @since 0.7.0
     *
     * @access public
     */
    public function enqueue_editor_assets() {
        wp_enqueue_script('e-addons-editor-twig');
    }

    protected function _register_controls() {

        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_assets']);

        $this->start_controls_section(
                'section_twig', [
            'label' => __('Text Editor with Twig', 'e-addons'),
                ]
        );



        $this->add_control(
                'text_w_twig',
                [
                    'label' => '', //__( 'Text with Twig', 'e-addons' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'default' => 'Hello {{user.display_name}}, you are using Elementor {{post._elementor_version}}',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'text_or_code' => '',
                    ]
                ]
        );

        $this->add_control(
                'code_w_twig',
                [
                    'label' => '', //__( 'Text with Twig', 'e-addons' ),
                    'type' => Controls_Manager::CODE,
                    'default' => 'Hello {{user.display_name}}, you are using Elementor {{post._elementor_version}}',
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'text_or_code' => 'yes',
                    ]
                ]
        );
        
        $this->add_control(
                'file_w_twig',
                [
                    'label' => 'Select TWIG Template File', //__( 'Text with Twig', 'e-addons' ),
                    'placeholder' => 'Ex: "wp-content/themes/my-theme/my-custom-file.twig"',
                    'type' => 'e-query',
                    'query_type' => 'files',
                    'label_block' => true,
                    'condition' => [
                        'text_or_code' => 'file',
                    ]
                ]
        );

        $this->add_control(
                'text_or_code',
                [
                    'label' => 'Source', //
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        '' => [
                            'title' => __('WYSIWYG Text', 'e-addons'),
                            'icon' => 'eicon-text',
                        ],
                        'yes' => [
                            'title' => __('CODE', 'e-addons'),
                            'icon' => 'eicon-editor-code',
                        ],
                        'file' => [
                            'title' => __('Template File', 'e-addons'),
                            'icon' => 'eicon-document-file',
                        ],
                    ],
                    'description' => __( 'Write in Visual way with WYSIWYG, paste the Twig Code or Include from a Template file', 'e-addons' ),
                ]
        );

        /* $this->add_control(
          'html_tag', [
          'label' => __('HTML Tag', 'elementor'),
          'type' => Controls_Manager::SELECT,
          'options' => [
          'h1' => 'H1',
          'h2' => 'H2',
          'h3' => 'H3',
          'h4' => 'H4',
          'h5' => 'H5',
          'h6' => 'H6',
          'div' => 'div',
          'span' => 'span',
          'ul' => 'ul',
          'ol' => 'ol',
          'p' => 'p',
          '' => __('NONE', 'e-addons'),
          ],
          ]
          ); */

        $this->end_controls_section();

        $this->start_controls_section(
                'section_style',
                [
                    'label' => __('Text Editor', 'e-addons'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_responsive_control(
                'align',
                [
                    'label' => __('Alignment', 'e-addons'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'e-addons'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', 'e-addons'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __('Right', 'e-addons'),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __('Justified', 'e-addons'),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .e-twigs' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'text_color',
                [
                    'label' => __('Text Color', 'e-addons'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .e-twigs' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'typography',
                    'selector' => '{{WRAPPER}} .e-twigs',
                ]
        );

        $text_columns = range(1, 10);
        $text_columns = array_combine($text_columns, $text_columns);
        $text_columns[''] = __('Default', 'elementor');

        $this->add_responsive_control(
                'text_columns',
                [
                    'label' => __('Columns', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'separator' => 'before',
                    'options' => $text_columns,
                    'selectors' => [
                        '{{WRAPPER}} .e-twigs' => 'columns: {{VALUE}};',
                    ],
                ]
        );

        $this->add_responsive_control(
                'column_gap',
                [
                    'label' => __('Columns Gap', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'vw'],
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                        '%' => [
                            'max' => 10,
                            'step' => 0.1,
                        ],
                        'vw' => [
                            'max' => 10,
                            'step' => 0.1,
                        ],
                        'em' => [
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .e-twigs' => 'column-gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();

        /* $this->start_controls_section(
          'section_twig_style',
          [
          'label' => __( 'Twig style', 'e-addons' ),
          'tab' => Controls_Manager::TAB_STYLE,
          'condition' => [
          'html_tag!' => '',
          ],
          ]
          );
          $this->add_control(
          'tolken_text_color',
          [
          'label' => __( 'Twig Color', 'e-addons' ),
          'type' => Controls_Manager::COLOR,
          'selectors' => [
          '{{WRAPPER}} .e-twigs .e-twig' => 'color: {{VALUE}};',
          ],
          ]
          );
          $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
          'name' => 'tolken_typography',
          'label' => __( 'Twig Typography', 'e-addons' ),
          'selector' => '{{WRAPPER}} .e-twigs .e-twig',
          ]
          );
          $this->end_controls_section(); */

    }

    protected function render() {
        $settings = $this->get_settings_for_display(null, true);

        $this->add_render_attribute('twig', 'class', ['e-twigs']);
        ?>
        <div <?php echo $this->get_render_attribute_string('twig'); ?>>
            <?php
            $text_w_twig = false;
            switch ($settings['text_or_code']) { 
                case 'file':
                    $file_path = ABSPATH . $settings['file_w_twig'];
                    if (file_exists($file_path)) {
                        $text_w_twig = file_get_contents($file_path);
                    }
                    break;
                case 'code':
                case 'yes':
                    $text_w_twig = $settings['code_w_twig'];
                    break;
                default:
                    $text_w_twig = $settings['text_w_twig'];
            }
            
            if ($text_w_twig) {
                /* if ($settings['html_tag']) {
                  $text_w_twig = str_replace('{{', '<'.$settings['html_tag'].' class="e-twig">{{', $text_w_twig);
                  $text_w_twig = str_replace('}}', '}}</'.$settings['html_tag'].'>', $text_w_twig);
                  } */
                echo Utils::get_dynamic_data($text_w_twig);
            } else {
                if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                    echo __('Add Text and Twig code to the Widget', 'e-addons');
                }
            }
            ?>
        </div>
        <?php
    }

}
