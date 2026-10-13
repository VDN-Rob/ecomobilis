-- Ecomobilis local test rides
-- Date: Friday, 16 October 2026
-- Run only against your LOCAL development database.
-- This script does not run migrations or alter the schema.
--
-- Preconditions based on the current local test setup:
--   carpool_street_coordinates IDs 1 and 2 exist
--   users ID 1 exists
--   carpool_luggages IDs 1, 2 and 3 exist
--
-- The two existing coordinates are:
--   ID 1: Place Maréchal Foch, Troyes
--   ID 2: Avenue du Général Leclerc, Saint-Julien-les-Villas
--
-- Safe to re-run: removes only rows created by this script, identified
-- by the TEST_SEED_2026-10-16: prefix in `remark`.

-- Run mysql -u db_user -p db_name < ecomobilis_test_rides_2026-10-16.sql

START TRANSACTION;

DELETE FROM carpool_rides
WHERE remark LIKE 'TEST_SEED_2026-10-16:%';

INSERT INTO carpool_rides (
    travel_start_datetime,
    from_street_coordinates_id,
    to_street_coordinates_id,
    luggage_id,
    seats_available,
    remark,
    price_per_seat,
    user_id,
    group_id,
    is_private,
    is_cancelled,
    created_at,
    updated_at
) VALUES
    (
        '2026-10-16 07:30:00',
        1, 2, 1, 3,
        'TEST_SEED_2026-10-16: Morning ride, no luggage',
        2.50, 1, NULL, 0, 0, NOW(), NOW()
    ),
    (
        '2026-10-16 08:15:00',
        1, 2, 2, 2,
        'TEST_SEED_2026-10-16: Morning ride, small bag',
        3.00, 1, NULL, 0, 0, NOW(), NOW()
    ),
    (
        '2026-10-16 12:00:00',
        2, 1, 3, 3,
        'TEST_SEED_2026-10-16: Midday return, suitcases',
        2.00, 1, NULL, 0, 0, NOW(), NOW()
    ),
    (
        '2026-10-16 17:15:00',
        1, 2, 1, 1,
        'TEST_SEED_2026-10-16: Evening ride, one seat left',
        4.00, 1, NULL, 0, 0, NOW(), NOW()
    ),
    (
        '2026-10-16 18:00:00',
        2, 1, 2, 2,
        'TEST_SEED_2026-10-16: Evening return, small bag',
        2.75, 1, NULL, 0, 0, NOW(), NOW()
    );

COMMIT;

-- Verify the inserted test rides.
SELECT
    id,
    travel_start_datetime,
    from_street_coordinates_id,
    to_street_coordinates_id,
    luggage_id,
    seats_available,
    price_per_seat,
    remark
FROM carpool_rides
WHERE remark LIKE 'TEST_SEED_2026-10-16:%'
ORDER BY travel_start_datetime;
