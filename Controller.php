<?php
declare(strict_types=1);

class YahtzeeController extends Yahtzee {
    /* Comment added to test GIT */
    private Yahtzee $model;
    private YahtzeeView $view;
    
    public function __construct(Yahtzee $model, YahtzeeView $view){
        $this->model = $model;
        $this->view = $view;
    }
    
    public function get_model() : Yahtzee {
        /*
        get_model() : YahtzeeModel
        > This method should return the model set by the constructor.
        */
        return $this->model;       
    }
    
    public function get_view() : YahtzeeView {
        /*
        get_view() : YahtzeeView
        > This method should return the view set by the constructor.
        */
        return $this->view;
    }
    
    public function get_possible_categories() : array {
        $rv = array();

        $keptDice = $this->model->get_kept_dice();

        $rv['ones'] = $this->calculate_number($keptDice, 1);
        $rv['twos'] = $this->calculate_number($keptDice, 2);
        $rv['threes'] = $this->calculate_number($keptDice, 3);
        $rv['fours'] = $this->calculate_number($keptDice, 4);
        $rv['fives'] = $this->calculate_number($keptDice, 5);
        $rv['sixes'] = $this->calculate_number($keptDice, 6);

        $rv['three_of_a_kind'] = $this->calculate_n_of_a_kind($keptDice, 3);
        $rv['four_of_a_kind'] = $this->calculate_n_of_a_kind($keptDice, 4);
        $rv['full_house'] = $this->calculate_full_house($keptDice);
        $rv['small_straight'] = $this->calculate_small_straight($keptDice);
        $rv['large_straight'] = $this->calculate_large_straight($keptDice);
        $rv['chance'] = $this->calculate_chance($keptDice);
        $rv['yahtzee'] = $this->calculate_yahtzee($keptDice);

        return $rv;
    }
    
    public function process_score_input(string $line): int {
      if ($line === 'exit' || $line === 'q') {
          return -1;
      }
  
      if (array_key_exists($line, $this->model->get_scorecard())) {
          $roll = $this->model->get_kept_dice();
          $score = $this->model->calculate($line, $roll);
          $this->model->update_scorecard($line, $score);
          return 0;
      } else {
          $scorecard = $this->model->get_scorecard();
          foreach ($scorecard as $category => $score) {
              if ($score === null) {
                  $roll = $this->model->get_kept_dice();
                  $score = $this->model->calculate($category, $roll);
                  $this->model->update_scorecard($category, $score);
                  return -2;
              }
          }
      }
      return -3;
  }
    
    public function process_keep_input(string $line) : int {
        /*
        process_keep_input(string $line) : int
        Processes the input from the user when determining which dice to keep.
        > If the line given is "exit" or "q", return -1.
        > If the line given is "all", immediately combine dice and return 0;
        > If the line given is "none" "pass" or blank "", return -2.
        - Otherwise, indexes are given
          > Attempt to call keep_by_index with the given line, return the int
            it returns, indicating remaining dice.
          > If keep_by_index throws an exception, catch it and return -2.
            (output the error message with the view).
        */
        
    }
    
    public function handle_roll() : int {
        /* 
        handle_roll() : int
        This method rolls the dice, up to three times, and gathers input from
        the user on what to do with each roll.  This method should:
        - Enter a loop that runs twice, and set a variable to track
          $remaining_dice to 5.
        - Each loop:
          - Roll dice, the amount being whats in $remaining_dice. (Use the view
            to output the last roll, and current kept dice.)
          - (Use the view to get user input, prompting them what they want to
            keep.)
          - Take the user input, feed it into process_keep_input()
            > If the return value is -2, nothing happens, continue the loop.
            > If the return value is -1, return -1.
            > else, set the $remaining_dice local var to the return value.
          > If the $remaining_dice is 0, break out of the loop.
        > After the loop, if the model's kept_dice has less than 5 dice,
          roll a final time, and then combine dice the kept_dice should be 
          correct based on the rolls and inputs.
        > Return 0.
          
        Hint for this one: What you can test from the result of this method is
        that 1) the kept_dice is properly populated given a variety of
        scenarios (simulate different inputs) and 2) the return value is
        correct.  You'll want to stub the view to return pre-scripted
        responses, a good way to do this is a stub's onConsecutiveCalls method.
        */
        
        return 0;
    }
    
    public function main_loop() : int {
        /*
        main_loop() : int
        Runs the main loop of the controller.
        > The loop should run exactly 13 times, and the model's current_turn
        should be incremented each time.
        - (Output the current turn with the view)
        > If handle_roll returns -1, return -1.
        - (Output the kept dice after handle_roll with the view)
        - Get the valid categories calling get_possible_categories
        - (Output valid categories with view)
        - (Get user input with view)
        > Call process_score_input on the result from the user input.
          > If the returning values is -1, return -1.
        - (use the view to output the score)
        > At the end of each loop iteration, clear_kept_dice and increment_turn
        
        Hint: For this, you can inspect the model to see if behavior is being
        properly called/implemented.  You will also need to stub view to give
        pre-scripted inputs.  Remember, we primarily want to test data and
        behavior, NOT implementation details.
        */
        
        
        return 0;
        
    }
}
