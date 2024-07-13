import { CKEditor } from '@ckeditor/ckeditor5-react';
import {
  AccessibilityHelp,
  Alignment,
  AutoLink,
  Autoformat,
  Autosave,
  BlockQuote,
  Bold,
  ClassicEditor,
  CodeBlock,
  Essentials,
  FindAndReplace,
  GeneralHtmlSupport,
  Heading,
  HorizontalLine,
  Indent,
  IndentBlock,
  Italic,
  Link,
  Paragraph,
  SelectAll,
  Style,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
  Undo,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
import translations from 'ckeditor5/translations/pt.js';
import { FC } from 'react';

export const Editor: FC<{ className?: string }> = ({ className }) => {
  return (
    <div className={className ? className : ''}>
      <CKEditor
        editor={ClassicEditor}
        config={{
          plugins: [
            AccessibilityHelp,
            Alignment,
            Autoformat,
            AutoLink,
            Autosave,
            BlockQuote,
            Bold,
            CodeBlock,
            Essentials,
            FindAndReplace,
            GeneralHtmlSupport,
            Heading,
            HorizontalLine,
            Indent,
            IndentBlock,
            Italic,
            Link,
            Paragraph,
            SelectAll,
            Style,
            Table,
            TableCaption,
            TableCellProperties,
            TableColumnResize,
            TableProperties,
            TableToolbar,
            TextTransformation,
            Undo,
          ],
          toolbar: {
            items: [
              'undo',
              'redo',
              '|',
              'findAndReplace',
              'selectAll',
              '|',
              'heading',
              'style',
              '|',
              'bold',
              'italic',
              '|',
              'horizontalLine',
              'link',
              'insertTable',
              'blockQuote',
              'codeBlock',
              '|',
              'alignment',
              '|',
              'indent',
              'outdent',
              '|',
              'accessibilityHelp',
            ],
            shouldNotGroupWhenFull: false,
          },
          heading: {
            options: [
              {
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph',
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1',
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2',
              },
              {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3',
              },
              {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4',
              },
              {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5',
              },
              {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6',
              },
            ],
          },
          language: 'pt',
          style: {
            definitions: [
              {
                name: 'Article category',
                element: 'h3',
                classes: ['category'],
              },
              {
                name: 'Title',
                element: 'h2',
                classes: ['document-title'],
              },
              {
                name: 'Subtitle',
                element: 'h3',
                classes: ['document-subtitle'],
              },
              {
                name: 'Info box',
                element: 'p',
                classes: ['info-box'],
              },
              {
                name: 'Side quote',
                element: 'blockquote',
                classes: ['side-quote'],
              },
              {
                name: 'Marker',
                element: 'span',
                classes: ['marker'],
              },
              {
                name: 'Spoiler',
                element: 'span',
                classes: ['spoiler'],
              },
              {
                name: 'Code (dark)',
                element: 'pre',
                classes: ['fancy-code', 'fancy-code-dark'],
              },
              {
                name: 'Code (bright)',
                element: 'pre',
                classes: ['fancy-code', 'fancy-code-bright'],
              },
            ],
          },
          table: {
            contentToolbar: [
              'tableColumn',
              'tableRow',
              'mergeTableCells',
              'tableProperties',
              'tableCellProperties',
            ],
          },
          translations: [translations],
        }}
      />
    </div>
  );
};
