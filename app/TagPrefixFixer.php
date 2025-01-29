<?php

namespace App;

use DOMNode;
use DOMElement;
use DOMDocument;

class TagPrefixFixer
{
    //

    protected static $notClosedTags = [
        'br', 'hr', 'img', 'input', 'meta', 'link', 'base', 'col', 'frame', 'area', 'param', 'command', 'keygen', 'source', 'track', 'wbr'
    ];

    /**
      * @desc Removes all prefixes from tags
      * @param string $xml The XML code to replace against.
      * @return string The XML code with no prefixes in the tags.
    */
    public static function Clean(string $xml) {

        $doc = new DOMDocument();
        /* Load the XML */
        $doc->loadXML($xml,
            LIBXML_HTML_NOIMPLIED | # Make sure no extra BODY
            LIBXML_HTML_NODEFDTD |  # or DOCTYPE is created
            LIBXML_NOERROR |        # Suppress any errors
            LIBXML_NOWARNING        # or warnings about prefixes.
        );
        /* Run the code */
        self::removeTagPrefixes($doc);
        /* Return only the XML */
        return $doc->saveXML();
    }

    private static function removeTagPrefixes(DOMNode $domNode) {
        /* Iterate over each child */
        foreach ($domNode->childNodes as $node) {
            /* Make sure the element is renameable and has children */
            if ($node->nodeType === 1) {
                /* Iterate recursively over the children.
                 * This is done before the renaming on purpose.
                 * If we rename this element, then the children, the element
                 * would need to be moved a lot more times due to how
                 * renameNode works. */
                if($node->hasChildNodes()) {
                    self::removeTagPrefixes($node);
                }
                /* Check if the tag contains a ':' */
                if (strpos($node->tagName, ':') !== false) {
                    print $node->tagName;
                    /* Get the last part of the tag name */
                    $parts = explode(':', $node->tagName);
                    $newTagName = end($parts);
                    /* Change the name of the tag */
                    self::renameNode($node, $newTagName);
                }
                /* Ensure the tag is properly closed */
                self::giveCloseTag($node);
            }
        }
    }

    private static function renameNode($node, $newName) {
        /* Create a new node with the new name */
        $newNode = $node->ownerDocument->createElement($newName);
        /* Copy over every attribute from the old node to the new one */
        foreach ($node->attributes as $attribute) {
            $newNode->setAttribute($attribute->nodeName, $attribute->nodeValue);
        }
        /* Copy over every child node to the new node */
        while ($node->firstChild) {
            $newNode->appendChild($node->firstChild);
        }
        /* Replace the old node with the new one */
        $node->parentNode->replaceChild($newNode, $node);
    }

    private static function giveCloseTag(DOMElement $node) {
        /* Check if the tag is not self-closing */
        if (in_array($node->tagName, self::$notClosedTags)) {
            /* If the tag is self-closing, add a slash to close it properly */
            $node->parentNode->replaceChild($node->ownerDocument->createTextNode('<' . $node->tagName . '/>'), $node);
        } else {
            /* Create a new node with the same name */
            $newNode = $node->ownerDocument->createElement($node->tagName);
            /* Copy over every attribute from the old node to the new one */
            foreach ($node->attributes as $attribute) {
                $newNode->setAttribute($attribute->nodeName, $attribute->nodeValue);
            }
            /* Copy over every child node to the new node */
            while ($node->firstChild) {
                $newNode->appendChild($node->firstChild);
            }
            /* Replace the old node with the new one */
            $node->parentNode->replaceChild($newNode, $node);
        }
    }

    private static function moveNestedParagraphs(DOMNode $domNode) {
        foreach ($domNode->childNodes as $node) {
            if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === 'p') {
                self::moveParagraphContent($node);
            }
            if ($node->hasChildNodes()) {
                self::moveNestedParagraphs($node);
            }
        }
    }

    private static function moveParagraphContent(DOMNode $paragraph) {
        $parent = $paragraph->parentNode;
        $nextSibling = $paragraph->nextSibling;
        while ($paragraph->firstChild) {
            $parent->insertBefore($paragraph->firstChild, $nextSibling);
        }
        $parent->removeChild($paragraph);
    }

    public static function cleanHTML($html) {
        $doc = new DOMDocument();
        /* Load the HTML */
        $doc->loadHTML($html,
                LIBXML_HTML_NOIMPLIED | # Make sure no extra BODY
                LIBXML_HTML_NODEFDTD |  # or DOCTYPE is created
                LIBXML_NOERROR |        # Suppress any errors
                LIBXML_NOWARNING        # or warnings about prefixes.
        );
        /* Run the code */
        foreach ($doc->getElementsByTagName('*') as $element) {
            self::giveCloseTag($element);
        }
        self::moveNestedParagraphs($doc);

        /* Immediately save the HTML and return it. */
        return $doc->saveHTML();
    }

    public static function addNamespaces($xml) {
        $root = '<w:wordDocument
            xmlns:w="http://schemas.microsoft.com/office/word/2003/wordml"
            xmlns:wx="http://schemas.microsoft.com/office/word/2003/auxHint"
            xmlns:o="urn:schemas-microsoft-com:office:office">';
        $root .= $xml;
        $root .= '</w:wordDocument>';
        return $root;
    }
}