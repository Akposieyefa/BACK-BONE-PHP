<?php
    include(ROOT_PATH. '/bootstrap/bootstrap.php');
      /**
       * This package is Developed by
       * NAME :: ORUTU AKPOSIEYEFA WILLIAMS
       * PHONE :: 08100788859
       * TWITTER :: @Orutu_AW
       * FACEBOOK :: ORUTU AKPOSIEYEFA WILLIAMS
       * MAY 2020 first realease
       *
       */
    class Pagination  extends DB
    {
        public static $link;
        public static $total_record_per_page;
        public static $page_no = 1;
        public static $total_record;
        public static $offset;
        public static $self;

        public static function Paginate($table,$number)
        {
            self::$total_record_per_page = $number;

            self::$self = $_SERVER['PHP_SELF'];
            if (isset($_GET['page_no']) && $_GET['page_no'] != 0) {
                self::$page_no = $_GET['page_no'];
            } else {
                self::$page_no = 1;
            }

            self::$offset =  (self::$page_no - 1) * self::$total_record_per_page;
            $previous_page = self::$page_no -1 ;
            $next_page = self::$page_no + 1;
            $adjacent = "2";

            $sql = "SELECT COUNT(*) AS total_record FROM $table";
            $stmt = parent::dbConnect()->prepare($sql);
            $stmt->execute();
            $result_count = $stmt->fetch(PDO::FETCH_ASSOC);

            self::$total_record = $result_count;
            self::$total_record = self::$total_record['total_record'];
            $total_no_of_pages = ceil(self::$total_record / self::$total_record_per_page);
            $second_last = $total_no_of_pages - 1;
            $mainOffset = self::$offset;
            $recordPerPage = self::$total_record_per_page;

            $sql = "SELECT * FROM $table LIMIT $mainOffset ,$recordPerPage";
            $stmt = parent::dbConnect()->prepare($sql);
            $stmt->execute();
            $records = [];
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
               extract($result);
               $records[] = $result;
            }
            if($records) {
                ?>
                <nav aria-label='Page navigation example'>
                    <ul class='pagination'>
                        <?php
                            if ($total_no_of_pages <= self::$total_record_per_page) {
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {

                                    if ($counter == self::$page_no) {
                                        echo "
                                        <li class='page-item'><a class='page-link' href=''>$counter</a></li>
                                    ";
                                    } else {
                                        echo "
                                        <li class='page-item'><a class='page-link' href='" . self::$self . "?page_no=" . $counter . "'>$counter</a></li>
                                ";
                                    }
                                }
                            }
                        ?>
                    </ul>
                </nav>
                <?php
                return $records;
             }
        }

}



