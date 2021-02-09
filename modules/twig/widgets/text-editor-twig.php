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
                        'text_or_code!' => '',
                    ]
                ]
        );

        $this->add_control(
                'text_or_code',
                [
                    'label' => 'Switch to CODE editor', //
                    'type' => Controls_Manager::SWITCHER,
                    'description' => __( 'Ideal for writing a more complex code', 'e-addons' ),
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


        $this->start_controls_section(
                'section_drop_cap',
                [
                    'label' => __('Drop Cap', 'elementor'),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'drop_cap' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_view',
                [
                    'label' => __('View', 'elementor'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'default' => __('Default', 'elementor'),
                        'stacked' => __('Stacked', 'elementor'),
                        'framed' => __('Framed', 'elementor'),
                    ],
                    'default' => 'default',
                    'prefix_class' => 'elementor-drop-cap-view-',
                    'condition' => [
                        'drop_cap' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_primary_color',
                [
                    'label' => __('Primary Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap, {{WRAPPER}}.elementor-drop-cap-view-default .elementor-drop-cap' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'drop_cap' => 'yes',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_secondary_color',
                [
                    'label' => __('Secondary Color', 'elementor'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}.elementor-drop-cap-view-framed .elementor-drop-cap' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}}.elementor-drop-cap-view-stacked .elementor-drop-cap' => 'color: {{VALUE}};',
                    ],
                    'condition' => [
                        'drop_cap_view!' => 'default',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_size',
                [
                    'label' => __('Size', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 5,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 30,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-drop-cap' => 'padding: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'drop_cap_view!' => 'default',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_space',
                [
                    'label' => __('Space', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        'body:not(.rtl) {{WRAPPER}} .elementor-drop-cap' => 'margin-right: {{SIZE}}{{UNIT}};',
                        'body.rtl {{WRAPPER}} .elementor-drop-cap' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_border_radius',
                [
                    'label' => __('Border Radius', 'elementor'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'default' => [
                        'unit' => '%',
                    ],
                    'range' => [
                        '%' => [
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-drop-cap' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'drop_cap_border_width', [
            'label' => __('Border Width', 'elementor'),
            'type' => Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .elementor-drop-cap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'drop_cap_view' => 'framed',
            ],
                ]
        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'drop_cap_typography',
                    'selector' => '{{WRAPPER}} .elementor-drop-cap-letter',
                    'exclude' => [
                        'letter_spacing',
                    ],
                    'condition' => [
                        'drop_cap' => 'yes',
                    ],
                ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(null, true);

        $this->add_render_attribute('twig', 'class', ['e-twigs']);
        ?>
        <div <?php echo $this->get_render_attribute_string('twig'); ?>>
            <?php
            $text_w_twig = $settings['text_or_code'] ? $settings['code_w_twig'] : $settings['text_w_twig'];
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
