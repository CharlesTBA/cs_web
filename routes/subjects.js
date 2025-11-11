const subjects = require('../data/subjects.json');

module.exports = (express) => {
  const router = express.Router();

  router.get('/', (req, res) => {
    res.json(subjects);
  });

  return router;
};
