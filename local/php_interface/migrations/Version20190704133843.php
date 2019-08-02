<?php

namespace Sprint\Migration;


class Version20190704133843 extends Version
{

    protected $description = "";

    public function up()
    {
        $helper = $this->getHelperManager();

        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'AsproNextContactReference',
  'TABLE_NAME' => 'b_hlbd_sposobyoplaty',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'double',
  'XML_ID' => 'UF_COLOR_SORT',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'PRECISION' => 0,
    'SIZE' => 20,
    'MIN_VALUE' => 0.0,
    'MAX_VALUE' => 0.0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_XML_ID',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_LINK',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_DESCRIPTION',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_FULL_DESCRIPTION',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_ICON_CLASS',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_ICON_CLASS',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Класс иконки',
    'ru' => 'Класс иконки',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Класс иконки',
    'ru' => 'Класс иконки',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Класс иконки',
    'ru' => 'Класс иконки',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'UF_COLOR_DEF',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextContactReference',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => 'UF_COLOR_FILE',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'AsproNextTizerReference',
  'TABLE_NAME' => 'next_tizers_reference',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextTizerReference',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextTizerReference',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'double',
  'XML_ID' => 'UF_COLOR_SORT',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'PRECISION' => 0,
    'SIZE' => 20,
    'MIN_VALUE' => 0.0,
    'MAX_VALUE' => 0.0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextTizerReference',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_XML_ID',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextTizerReference',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_LINK',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextTizerReference',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => 'UF_COLOR_FILE',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'AsproNextColorReference',
  'TABLE_NAME' => 'next_color_reference',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_NAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Название',
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'double',
  'XML_ID' => 'UF_COLOR_SORT',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'PRECISION' => 0,
    'SIZE' => 20,
    'MIN_VALUE' => 0.0,
    'MAX_VALUE' => 0.0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_XML_ID',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'XML_ID',
    'ru' => 'XML_ID',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_LINK',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ссылка',
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_DESCRIPTION',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Описание',
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_COLOR_FULL_DESCRIPTION',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Полное описание',
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'UF_COLOR_DEF',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'По умолчанию',
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_AsproNextColorReference',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => 'UF_COLOR_FILE',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Файл',
    'ru' => 'Файл',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Baza1c',
  'TABLE_NAME' => 'b_hlbd_baza1c',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Baza1c',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Tipmebeli',
  'TABLE_NAME' => 'b_hlbd_tipmebeli',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Tipmebeli',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Parkovka',
  'TABLE_NAME' => 'b_hlbd_parkovka',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Parkovka',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Colorbase',
  'TABLE_NAME' => 'b_hlbd_colorbase',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Colorbase',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Colorbase',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Serii',
  'TABLE_NAME' => 'b_hlbd_serii',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Serii',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Material',
  'TABLE_NAME' => 'b_hlbd_material',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Material',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Polzovateli',
  'TABLE_NAME' => 'b_polzovateli',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'N',
  'EDIT_IN_LIST' => 'N',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_VERSION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'N',
  'EDIT_IN_LIST' => 'N',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_KOD',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'Код',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_POMETKAUDALENIYA',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'ПометкаУдаления',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'ПометкаУдаления',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_NEDEYSTVITELEN',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'Недействителен',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Недействителен',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_PODRAZDELENIE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'Подразделение',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Подразделение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_FIZICHESKOELITSO',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'ФизическоеЛицо',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Физическое лицо',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Polzovateli',
  'FIELD_NAME' => 'UF_KOMMENTARIY',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'Комментарий',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Комментарий',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Model',
  'TABLE_NAME' => 'b_hlbd_model',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_MENU',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => '1',
    'DISPLAY' => 'DROPDOWN',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Отображать в меню',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Отображать в меню',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Отображать в меню',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => '',
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Model',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
        
        $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'Metki',
  'TABLE_NAME' => 'b_hlbd_metki',
  'LANG' => 
  array (
  ),
));

                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Название',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Сортировка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_XML_ID',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '400',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Внешний код',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_LINK',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Ссылка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => NULL,
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Полное описание',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_DEF',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 0,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => NULL,
      1 => NULL,
    ),
    'LABEL_CHECKBOX' => NULL,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'По умолчанию',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
                $helper->UserTypeEntity()->saveUserTypeEntity(array (
  'ENTITY_ID' => 'HLBLOCK_Metki',
  'FIELD_NAME' => 'UF_FILE',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'ru' => 'Изображение',
  ),
  'ERROR_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'ru' => NULL,
  ),
));
        
            }

    public function down()
    {
        $helper = $this->getHelperManager();

        //your code ...
    }

}
