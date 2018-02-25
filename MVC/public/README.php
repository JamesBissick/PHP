<?php
    ## Modifier httpd.conf

    // Changer root directory (ctrl+f = root)


    ## Each Class in a separate file
    /* Not required, but has advantages
        - Easier to find a specific Class in your code --> easier to maintain
        - Can load the Class files automatically */



    ## Require or include?
    /* To use the class, we need to load the file it's in:
        include, if file not find will carry on
        require, if file not find, will stop the code and produce an error */



    #### Regular expressions ###
    // A regular expression describes a pattern of characters
    // Can match part of a string
    // Can be used for advancer matching and replacing:
    /* 
        - match or replace just numbers in a string
        - see if a string contains a valid email address, etc
    */

    ## Simple Character matching
    // Everything is a character: letters, numbers, punctuaction etc
    /* 
        /abc/    |   abc    | TRUE                                     \d | any digit from 0 to 9
        /abc/    |  abcdef  | TRUE                                     \w | any word character from a to z, A to Z and 0 to 9
        /abc/    |   bcde   | FALSE     #missing an 'a'                \s | any whitespace character (space, tab, etc.)
        /2:3/    | 12:34:56 | TRUE
        /ab\d    |   ab23   | TRUE
        /abc\d   |   ab23   | FALSE     #missing an 'c'
        /\d\d/   |   ab23   | TRUE      #asking for 2 digits
        /\w\s\d/ |   ab 34  | TRUE      #has characters, digits and space: ok
        
        Ressources: www.phpliveregex.com
    


    ## Advanced Regular expressions
    
    // Starting and Ending  
        ^ = the start of the string;
        $ = the end of the string; 

        /^abc/     |   abc    | TRUE                                     
        /^123abc/  |  123abc  | FALSE     # the string doesn't start with abc                                     
        /123abc$/  |   bcde   | TRUE      # ends with abc, correct               
        /^abc$/    | abcdef   | FALSE     # starts with abc but doesn't end with abc

    // Repetition
        * = zero or more;
        + = one or more;

        /a*bc/    |   abc    | TRUE      # zero or more a
        /a+bc/    |   bc     | FALSE     # 1 or more a, missing a
        /a+bc/    |  aaaabc  | TRUE      # 1 or more a, correct

    // Wildcards
        . = match any single character: letter, number, whitespace, etc

        /ab.de/   |   abcde   | TRUE      # correct
        /ab.de/   |   ab4de   | TRUE      # correct
        /ab.de/   |   ab de   | TRUE      # correct
        /ab.de/   |   abde    | FALSE     # incorrect, there is no character between 'ab' and 'de'

        You can combine commands too:
        /abc.* /  |   abcdef  | TRUE      # correct, matches the zero or more wildcards command
        /abc.* /  |    abc    | TRUE      # correct, matches the zero or more wildcards command, even none

    // Escaping:
        \ = match metacharacters by escaping them

        /abc./    |   abcd    | TRUE      # correct, dot interpreted as a wildcard
        /abc\./   |   abcd    | FALSE     # incorrect, no dot character
        /abc\./   |   abc.    | TRUE      # correct, found dot character

    // Case sensitive modifier
        Patterns are case sensitive. Adding the i modifier after the regular expression makes it case insensitive

        /abc/     |    abc    | TRUE         # correct, case sensitivity respected
        /abc/     |    ABc    | TRUE         # incorrect, case sensitivity not respected
        /abc/i    |    aBC    | TRUE         # correct, case insensitivity activated



    ## Powerful regular expressions: character sets and rangers
    
    // Character sets
        [] = Match one of any of the characters in the brakets, ex: [abc] will match a, b or c and nothing else:
        
        /a[123]b/  |    a2c    | TRUE         # correct, matches ONE of the characters inside brackets 
        /a[123]b/  |    a3c    | TRUE         # correct, matches ONE of the characters inside brackets 
        /a[123]b/  |    a4c    | FALSE        # incorrect, doesnt match either of the characters inside brackets 
        /a[123]+b/ |  a321322b | TRUE         # correct, matches ONE OR MORE of the characters inside brackets 

    // Character ranges
        [-] = specifies a range of characters inside a character set, ex: [0-9] will match a single digit between 0 and 9, and nothing else

        /a[1-5]b/    |     a2c      | TRUE         # correct, digit inside the range  
        /a[1-5]b/    |     a6c      | FASLE        # incorrect, digit outside the range 
        /[a-z0-9 ]+/ |  hello there | TRUE         # correct, letters inside the range, digit inside the range and space, ONE OR MORE

    // Negated character sets
        [^ ] = negates the character class: matches any one character except for the characters specified, including ranges

        /a[^123]b/   |     a2b      | FALSE          # incorrect, digit inside the range is forbidden
        /a[^123]b/   |     a4b      | TRUE           # correct, anything but 123 
        /[^a-z]+/    |    hello     | FASLE          # incorrect, anything but letters inside the range a-z in lowercase
        /[^a-z]+/    |    HELLO     | FASLE          # correct, uppercase entered, anything but letters inside the range a-z in lowercase


    ## Extract parts of strings using regular expression capture groups

    // Regular expression matching in PHP
        preg_match($reg_exp, $string);
        preg_match("/[a-z]+/", "abcd") => returns 1
        preg_match("/[a-z]+/", "1234") => returns 0

    // Capture groups in regular expressions
        () = capture the regular expression inside the parentheses (the subpattern) to a capture group
            preg_match($reg_exp, $string, $matches);
        
        /a[123]+b/  |  a22b   | [ 0 => "a22b" ]
        /([a-zA-Z]+) (\d+) | Jan 1992 | 
        
        // Result ($matches):
        [ 0 => "Jan 1992",
          1 => "Jan",
          2 => "1992 ]


    // Names capture groups
        (?<name>regex) = gives the capture group a name

        /(?<month>[a-zA-Z]+) (?<year>\d+/)  |  Jan 1992  | [ 0 => "a22b" ]
        
        // Result ($matches):
        [ 0 => "Jan 1992",
          1 => "Jan",
          2 => "1992 ]

    ## A regular expression for a simple URL structure
            
        /^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+$)/

        preg_match($reg_exp, "posts/index", $matches)

        // Result ($matches):
        [
            "controller" => "posts",
            "action" => "index"
        ]

    
    ## Regular expression replacing in PHP

    // Searches $string for matches to $reg_exp and replaces them with $replacement
    $result = preg_replace($reg_exp, $replacement, $string)
                            /abc/  |    def   |     abc    |   => def
                            /\d+/  |    --    |  abc123def |   => abc--def        \d | any digit from 0 to 9, one or more
                            /\s+/  |     ,    |  a b  c  d |   => a,b,c,d         \s | whitespace, one or more
    
    ## Backreferences to capture groups
    // Refer to the text in a capture group using \1, \2 and so on

                           /ab(c)/ |  \1de    |     abc     |   => cde             \1 | replace letter by 1st letter in parenthesis and the rest by de
                 /(\w+) and (\w+)/ | \1 or \2 |Jack and Jill|   => Jack or Jill    \w | any word character from a to z, A to Z and 0 to 9, words


    */
?>